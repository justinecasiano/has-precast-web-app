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

    // vulnerable to SQL injection
    public function query($string)
    {
        return $this->conn->query($string)->fetch(PDO::FETCH_ASSOC);
    }

    public function createAccount(Account $account)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO `account` 
            (`first_name`, `last_name`, `email`, `password`, `type_id`)
            VALUES (?, ?, ?, ?, 1001)"
        );
        $stmt->execute($account->getFields());
    }

    public function getAllAccounts()
    {
        $results = $this->conn->query(
            "SELECT * FROM `account`"
        )->fetchAll(PDO::FETCH_ASSOC);

        $accounts = [];
        foreach ($results as $key => $result) {
            extract($result);
            array_push($accounts, new Account(
                $first_name,
                $last_name,
                $email,
                $password
            ));
        }
        return $accounts;
    }

    public function findAccount($email)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM `account` WHERE `email` = ?"
        );
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function doesAccountExist($email): bool
    {
        return (bool) $this->findAccount($email);
    }

    public function isAccountValid($email, $password): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM `account` WHERE `email` = ? AND `password` = ?"
        );
        $stmt->execute([$email, $password]);
        return (bool) $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
