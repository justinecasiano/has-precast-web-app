<?php

class Repository
{
    private $db;
    private $conn;

    public function __construct(Database $db)
    {
        $this->db = $db;
        $this->conn = $this->db->getConnection();
    }

    public function query($string)
    {
        return $this->conn->query($string)->fetch(PDO::FETCH_ASSOC);
    }

    public function searchUser($email, $origin)
    {
        $table = ($origin === 'http://has-precast.com') ? 'account' : 'moderator';
        $name = ($origin === 'http://has-precast.com') ? "`first_name` AS 'name'" : "`name`";

        $query = "SELECT `id`, $name, `email` FROM `$table` WHERE email=?";
        $statement = $this->conn->prepare($query);
        $statement->execute([$email]);
        return $statement->fetch();
    }

    public function createUser($values)
    {
        extract($values);
        $isExecuted = true;
        $password = password_hash($password, PASSWORD_DEFAULT);

        if ($first_name) {
            $query = "INSERT INTO `account` (`first_name`, `last_name`, `email`, `password`) VALUES (?, ?, ?, ?)";
            $statement = $this->conn->prepare($query);
            $isExecuted = $statement->execute([$first_name, $last_name, $email, $password]);
        } else {
            $query = "INSERT INTO `moderator` (`name`, `email`, `password`) VALUES (?, ?, ?)";
            $statement = $this->conn->prepare($query);
            $isExecuted = $statement->execute([$name, $email, $password]);
        }
        return $isExecuted;
    }

    public function changePassword($values, $origin)
    {
        $table = ($origin === 'http://admin.has-precast.com') ? 'moderator' : 'account';
        extract($values);

        $query = "SELECT * FROM `$table` WHERE `email`=? AND `status`='ACTIVE'";
        $statement = $this->conn->prepare($query);
        $statement->execute([$email]);
        $result = $statement->fetch();

        if ($result) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE $table SET `password`=? WHERE `email`=?";
            $statement = $this->conn->prepare($query);
            $statement->execute([$password, $email]);

            if ($table === 'account') generateDialogBox('change-password', 'Successfully changed password. You may now login.', 5, type: 'success');
            else generateDialogBox('has-precast/change-password.php', 'Successfully changed password. You may now login.', 5, type: 'success', domain: 'admin.has-precast.com');
        } else {
            if ($table === 'account') generateDialogBox('change-password', 'Account does not exist. Please try again.', 5, type: 'error');
            else generateDialogBox('has-precast/change-password.php', 'Account does not exist. Please try again.', 5, type: 'error', domain: 'admin.has-precast.com');
        }
    }

    public function authenticate($values, $table)
    {
        extract($values);
        $query = "SELECT * FROM `$table` WHERE `email`=? AND `status`='ACTIVE'";
        $statement = $this->conn->prepare($query);
        $statement->execute([$email]);
        return $statement->fetch();
    }

    public function getWallFormBlocks()
    {
        $query = "SELECT * FROM `wall_form_block` WHERE `default` = 1 AND `status` = 'AVAIL'";
        return $this->conn->query($query)->fetchAll();
    }

    public function addToCart($values)
    {
        extract($values);
        $query = "INSERT INTO `cart` (`account_id`, `wall_form_block_id`, `size`, `quantity`) VALUES (?, ?, ?, ?)";
        $statement = $this->conn->prepare($query);
        $isExecuted = $statement->execute([$account_id, $wall_form_block_id, $size, $quantity]);
        return $isExecuted ? $this->conn->lastInsertId() : 0;
    }

    public function removeToCart($cart_id)
    {
        $query = "DELETE FROM `cart` WHERE `id`=?";
        $statement = $this->conn->prepare($query);
        return $statement->execute([$cart_id]);
    }

    public function getCart($account_id)
    {
        $query = "SELECT c.`id` AS 'cart_id', c.`size`, c.`quantity`,
        wfb.`id` as 'wfb_id' ,wfb.`design_name`, wfb.`description`, wfb.`cart_image` 
        FROM `cart` c JOIN `wall_form_block` wfb 
        ON c.`wall_form_block_id` = wfb.`id` WHERE `account_id`=?
        ORDER BY `cart_id`";
        $statement = $this->conn->prepare($query);
        $statement->execute([$account_id]);
        return $statement->fetchAll();
    }

    public function addToOrder($values)
    {
        $query = "INSERT INTO `billing` (`account_id`, `quotation`) VALUES (?, NULL)";
        $statement = $this->conn->prepare($query);
        $statement->execute([$_SESSION['id']]);
        $billing_id = $this->conn->lastInsertId();

        $count = 0;
        $orders = json_decode($values);
        for ($i = 0; $i < count($orders); $i++) {
            $query = "INSERT INTO `order` (`billing_id`, `wall_form_block_id`, `size`, `quantity`) VALUES (?, ?, ?, ?)";
            $statement = $this->conn->prepare($query);
            $isInsertExecuted = $statement->execute([$billing_id, $orders[$i]->wall_form_block_id, $orders[$i]->size, $orders[$i]->quantity]);

            $query = "DELETE FROM `cart` WHERE id=?";
            $statement = $this->conn->prepare($query);
            $isDeleteExecuted = $statement->execute([$orders[$i]->cart_id]);

            if ($isDeleteExecuted and $isInsertExecuted) $count++;
        }
        return $count;
    }

    public function getOrders($account_id, $origin)
    {
        $where = $origin === 'http://admin.has-precast.com' ? '' : 'AND account_id=?';

        $query = "SELECT b.`id` AS 'billing_id', o.`id` AS 'order_id', o.`size`, o.`quantity`, 
        wfb.`design_name`, b.`quotation`, b.`status`, b.`payment_status`, b.`delivery_date`, CONCAT(`first_name`, ' ', `last_name`) AS 'name', `type`
        FROM `order` o
        JOIN `billing` b ON o.`billing_id` = b.`id`
        JOIN `wall_form_block` wfb ON o.`wall_form_block_id` = wfb.`id` 
        JOIN `account` a ON b.`account_id` = a.`id`
        JOIN `account_type` t ON a.`type_id` = t.`id`
        WHERE o.`billing_id` = b.`id` $where ORDER BY b.`id` DESC, o.`id` DESC";
        $statement = $this->conn->prepare($query);
        $statement->execute($where ? [$account_id] : null);

        $count = 0;
        $billings = [];
        foreach ($statement->fetchAll() as $row) {
            extract($row);
            $id = $billing_id;
            unset($row['billing_id'], $row['quotation'], $row['status'], $row['name'], $row['type'], $row['payment_status'], $row['delivery_date']);

            if (isset($billings[$id])) {
                $billings[$id]['orders'][$count++] = $row;
            } else {
                $count = 0;
                $billings[$id]['orders'][$count++] = $row;
                $billings[$id]['quotation'] = $quotation;
                $billings[$id]['status'] = $status;
                $billings[$id]['name'] = $name;
                $billings[$id]['type'] = $type;
                $billings[$id]['payment_status'] = $payment_status;
                $billings[$id]['delivery_date'] = $delivery_date;
            }
        }
        return $billings;
    }

    public function addMessage($values)
    {
        extract($values);

        $query = "INSERT INTO `chat` (`billing_id`, `message`, `sender`) VALUES (?, ?, ?)";
        $statement = $this->conn->prepare($query);
        return $statement->execute([$billing_id, $message, $sender]);
    }

    public function getMessages($billing_id, $origin)
    {
        $name = $origin === 'http://admin.has-precast.com' ? ", `first_name` AS 'name'" : '';
        $join = $origin === 'http://admin.has-precast.com' ?
            "JOIN `billing` b ON c.`billing_id` = b.`id`
             JOIN `account` a ON b.`account_id` = a.`id`" : '';

        $query = "SELECT c.`id`, `message`, `sender`, `date_time_sent` $name
        FROM `chat` c $join WHERE c.`billing_id`=? ORDER BY c.`id`";
        $statement = $this->conn->prepare($query);
        $statement->execute([$billing_id]);
        return $statement->fetchAll();
    }

    public function getNewMessages($values, $origin)
    {
        extract($values);
        $sender = $origin === 'http://admin.has-precast.com' ? 'CLIENT' : 'ADMIN';
        $name = $origin === 'http://admin.has-precast.com' ? ", `first_name` AS 'name'" : '';
        $join = $origin === 'http://admin.has-precast.com' ?
            "JOIN `billing` b ON c.`billing_id` = b.`id`
             JOIN `account` a ON b.`account_id` = a.`id`" : '';

        $query = "SELECT c.`id`, `message`, `sender`, `date_time_sent` $name FROM `chat` c
        $join WHERE c.`billing_id`=? AND c.`id` > ? AND c.`sender`=? ORDER BY c.`id`";
        $statement = $this->conn->prepare($query);
        $statement->execute([$billing_id, $id, $sender]);
        return $statement->fetchAll();
    }

    public function getNewBillings($billing_id)
    {
        $query = "SELECT * FROM `billing` WHERE `id`>?";
        $statement = $this->conn->prepare($query);
        $statement->execute([$billing_id]);
        return $statement->fetch();
    }

    public function newQuoteMessage($billing_id, $message)
    {
        $query = "INSERT INTO `chat` (`billing_id`, `message`, `sender`) VALUES (?, ?, ?)";
        $statement = $this->conn->prepare($query);
        $statement->execute([$billing_id, $message, 'CLIENT']);
    }

    public function getQuotation($billing_id)
    {
        $query = "SELECT quotation FROM `billing` WHERE `id`=?";
        $statement = $this->conn->prepare($query);
        $statement->execute([$billing_id]);
        return $statement->fetch()['quotation'];
    }

    public function setQuotation($values)
    {
        extract($values);
        $result = $this->getQuotation($billing_id);

        if (!$result) {
            $query = "UPDATE `billing` SET quotation=? WHERE `id`=?";
            $statement = $this->conn->prepare($query);
            $statement->execute([$quotation, $billing_id]);

            $query = "DELETE FROM `chat` WHERE `billing_id`=? AND `message` LIKE '%\"QUOTE\"%'";
            $statement = $this->conn->prepare($query);
            $statement->execute([$billing_id]);

            $quote = number_format($quotation, 2);
            $message = "Client has accepted the quotation price of: ₱$quote";
            $this->newQuoteMessage($billing_id, $message);

            $result = $quotation;
        }
        return $result;
    }

    public function removeQuotation($values)
    {
        extract($values);
        $query = "DELETE FROM `chat` WHERE `billing_id`=? AND `id`=?";
        $statement = $this->conn->prepare($query);
        $statement->execute([$billing_id, $id]);

        $quote = number_format($quotation, 2);
        $message = "Client has rejected the quotation price of: ₱$quote";
        $this->newQuoteMessage($billing_id, $message);
    }

    public function getPayment($billing_id)
    {
        $query = "SELECT payment_method, payment_reference, payment_date, payment_status, DATE(delivery_date) AS 'delivery_date'
        FROM `billing` WHERE `id`=? AND `quotation` IS NOT NULL";
        $statement = $this->conn->prepare($query);
        $statement->execute([$billing_id]);
        return $statement->fetch();
    }

    public function submitPayment($values)
    {
        extract($values);
        $query = "UPDATE `billing` SET payment_method=?, payment_reference=?, delivery_date=?, payment_status=? WHERE `id`=? AND `quotation` IS NOT NULL";
        $statement = $this->conn->prepare($query);
        return $statement->execute([$payment_method, $payment_reference, $delivery_date, 'VERIFYING', $billing_id]);
    }

    public function setPaymentStatus($values)
    {
        extract($values);
        if ($payment_status === 'PAID') {
            $query = "UPDATE `billing` SET `status`=? WHERE `id`=? AND `quotation` IS NOT NULL";
            $statement = $this->conn->prepare($query);
            $statement->execute(['CLOSED', $billing_id]);
        }

        $query = "UPDATE `billing` SET payment_status=? WHERE `id`=? AND `quotation` IS NOT NULL";
        $statement = $this->conn->prepare($query);
        return $statement->execute([$payment_status, $billing_id]);
    }
}
