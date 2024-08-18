<?php
class BackendController
{
    private $path;
    private $params;
    private $routes;
    private $repo;

    public function __construct(string $path, array $params, array $routes, $repo)
    {
        if (isset($_SERVER['HTTP_ORIGIN']) and in_array($_SERVER['HTTP_ORIGIN'], ['http://has-precast.com', 'http://admin.has-precast.com'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header("Access-Control-Allow-Credentials: true");
            header("'Access-Control-Allow-Methods', GET, POST, PUT, DELETE, OPTIONS");
            header("Access-Control-Allow-Methods','Content-Type','Authorization");
            header("Access-Control-Allow-Headers: X-Requested-With");
        }

        $this->path = $path;
        $this->params = $params;
        $this->routes = $routes;
        $this->repo = $repo;
        $this->handle();
    }

    public function handle(): void
    {
        $match = $this->findMatch();
        if ($match['handler'] !== 'error' and isset($match['middlewares'])) {
            foreach ($match['middlewares'] as $middleware) {
                if (str_contains($middleware, 'validate'))
                    $middleware($this->params, $this->repo);
                else $middleware();
            }
        }
        $this->{$match['handler']}();
    }

    public function findMatch(): array
    {
        $match['handler'] = 'error';

        foreach ($this->routes as $routes) {
            foreach ($routes as $route) {
                [$path, $handler] = $route;

                $pattern = "/^\/$path(\?(.+))?\/?$/";

                if (preg_match($pattern, $this->path)) {
                    $match['handler'] = $handler;
                    if (!empty($route[2])) $match['middlewares'] = $route[2];
                    break;
                }
            }
        }
        return $match;
    }

    public function getUser()
    {
        $user = ['email' => 'none'];

        if (!empty($_SESSION)) {
            $currentUser = $this->repo->searchUser($_SESSION['email'], $_SERVER['HTTP_ORIGIN']);
            if ($currentUser) $user = $currentUser;
        }
        echo json_encode($user);
    }

    public function signup()
    {
        if ($this->repo->createUser($this->params)) generateDialogBox('signup', 'Created an account successfully.', 5, type: 'success');
        else generateDialogBox('signup', 'Failed to create user. Please try again.', 5, type: 'error');
    }

    public function login()
    {
        extract($this->params);
        $table = ['http://has-precast.com' => 'account', 'http://admin.has-precast.com' => 'moderator'];
        $result = $this->repo->authenticate($this->params, $table[$_SERVER['HTTP_ORIGIN']]);
        $table = $table[$_SERVER['HTTP_ORIGIN']];

        if ($result) {
            if (password_verify($password, $result['password'])) {
                $_SESSION['id'] = $result['id'];
                $_SESSION['email'] = $result['email'];

                if ($table === 'account') generateDialogBox('home', 'Logged in successfully.', 10, type: 'success');
                else if ($result['type'] === 'Admin') generateDialogBox('has-precast/admin-index.php', 'Logged in successfully.', 10, type: 'success', domain: 'admin.has-precast.com', extra: "userid={$result['name']}&userAccountType={$result['type']}");
                else generateDialogBox('has-precast/content-management.php', 'Logged in successfully.', 10, type: 'success', domain: 'admin.has-precast.com', extra: "userid={$result['name']}&userAccountType={$result['type']}");
            } else {
                if ($table === 'account') generateDialogBox('login', 'Incorrect email or password. Please try again.', 5, type: 'error');
                else generateDialogBox('has-precast/admin-log-in.php', 'Incorrect email or password. Please try again.', 5, type: 'error', domain: 'admin.has-precast.com');
            }
        } else {
            if ($table === 'account') generateDialogBox('login', 'Account does not exist. Please try again.', 5, type: 'error');
            else generateDialogBox('has-precast/admin-log-in.php', 'Account does not exist. Please try again.', 5, type: 'error', domain: 'admin.has-precast.com');
        }
    }

    public function changePassword()
    {
        $this->repo->changePassword($this->params, $_SERVER['HTTP_ORIGIN']);
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
    }

    public function getWallFormBlocks()
    {
        echo json_encode($this->repo->getWallFormBlocks());
    }

    public function addToCart()
    {
        echo json_encode($this->repo->addToCart($this->params));
    }

    public function removeToCart()
    {
        echo json_encode($this->repo->removeToCart($this->params['cart_id']));
    }

    public function getCart()
    {
        echo json_encode($this->repo->getCart($this->params['account_id']));
    }

    public function addToOrder()
    {
        echo json_encode($this->repo->addToOrder($this->params['order']));
    }

    public function getOrders()
    {
        echo json_encode($this->repo->getOrders($this->params['account_id'], $_SERVER['HTTP_ORIGIN']));
    }

    public function addMessage()
    {
        echo json_encode($this->repo->addMessage($this->params));
    }

    public function getMessages()
    {
        echo json_encode($this->repo->getMessages($this->params['billing_id'], $_SERVER['HTTP_ORIGIN']));
    }

    public function getNewMessages()
    {
        echo json_encode($this->repo->getNewMessages($this->params, $_SERVER['HTTP_ORIGIN']));
    }

    public function getNewBillings()
    {
        echo json_encode($this->repo->getNewBillings($this->params['billing_id']));
    }

    public function getQuotation()
    {
        echo json_encode($this->repo->getQuotation($this->params['billing_id']));
    }

    public function setQuotation()
    {
        echo json_encode($this->repo->setQuotation($this->params));
    }

    public function removeQuotation()
    {
        echo json_encode($this->repo->removeQuotation($this->params));
    }

    public function getPayment()
    {
        echo json_encode($this->repo->getPayment($this->params['billing_id']));
    }

    public function submitPayment()
    {
        if ($this->repo->getPayment($this->params['billing_id'])['payment_status'] === 'VERIFYING') generateDialogBox('home', 'Payment is already submitted for verification', 5, 5, type: 'error');
        if ($this->repo->getPayment($this->params['billing_id'])['payment_status'] === 'PAID') generateDialogBox('home', 'You have already paid', 5, 5, type: 'error');
        if ($this->repo->submitPayment($this->params)) generateDialogBox('home', 'Payment submitted. Please wait for Admin to verify it.', 5, 5, type: 'success');
    }

    public function setPaymentStatus()
    {
        if ($this->repo->setPaymentStatus($this->params)) generateDialogBox('has-precast/chat.php', 'Payment status updated.', 5, type: 'success', domain: 'admin.has-precast.com');
    }

    public function error()
    {
        return http_response_code(400);
    }
}
