<?php

function isAuthorized()
{
    if (!isset($_SESSION['email'])) {
        echo json_encode(['message' => 'there is no user associated with this session']);
        return http_response_code(400);
    }
}

function validateSubmitPayment($params, $repo)
{
    extract($params);
    foreach ($params as $key => $value) {
        if (empty($value))
            generateDialogBox('home', "Empty input is not allowed.<br>Please try again.", 5, 5, type: 'error');
    }
    if (strlen($payment_reference) < 10) generateDialogBox('home', "Reference number must be greater than 10 characters.<br>Please try again.", 5, 5, type: 'error');
}

function validateChangePassword($params, $repo)
{
    $table = ['http://has-precast.com' => 'account', 'http://admin.has-precast.com' => 'moderator'];
    $table = $table[$_SERVER['HTTP_ORIGIN']];
    extract($params);

    foreach ($params as $key => $value) {
        if (empty($value))
            if ($table === 'account') generateDialogBox('change-password', 'Empty input is not allowed.<br>Please try again.', 5, type: 'error');
            else generateDialogBox('has-precast/change-password.php', 'Empty input is not allowed.<br>Please try again.', 5, type: 'error', domain: 'admin.has-precast.com');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($table === 'account') generateDialogBox('change-password', 'Invalid email. Please try again.', 5, type: 'error');
        else generateDialogBox('has-precast/change-password.php', 'Invalid email. Please try again.', 5, type: 'error', domain: 'admin.has-precast.com');
    }

    if ($password !== $confirm_password) {
        if ($table === 'account') generateDialogBox('change-password', 'Your password and confirm password does not match.<br>Please try again.', 5, type: 'error');
        else generateDialogBox('has-precast/change-password.php', 'Invalid email. Please try again.', 5, type: 'error', domain: 'admin.has-precast.com');
    }

    if (!preg_match("/^[a-zA-Z_0-9]{8,}$/", $password)) {
        if ($table === 'account') generateDialogBox('change-password', 'Your password must satisfy:<br><br> a minimum of 8 characters<br> Special character allowed is underscore<br> Strictly no spaces.<br> Please try again.', 5, type: 'error');
        else generateDialogBox('has-precast/change-password.php', 'Your password must satisfy:<br><br> a minimum of 8 characters<br> Special character allowed is underscore<br> Strictly no spaces.<br> Please try again.', 5, type: 'error', domain: 'admin.has-precast.com');
    }
}

function validateSignUp($params, $repo)
{
    extract($params);
    foreach ($params as $key => $value) {
        if (empty($value))
            generateDialogBox('signup', 'Empty input is not allowed.<br>Please try again.', 5, type: 'error');
    }

    if ($name) {
        if (!preg_match("/^[a-zA-Z\s]*$/", trim($name)))
            // change to admin.has-precast.com path
            generateDialogBox('signup', 'Name is not valid. Please try again.', 5, type: 'error', domain: 'admin.has-precast.com');
    } else {
        if (!preg_match("/^[a-zA-Z]*$/", $first_name) || !preg_match("/^[a-zA-Z]*$/", $last_name))
            generateDialogBox('signup', 'First name or Last name is not valid. Please try again.', 5, type: 'error');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) generateDialogBox('signup', 'Invalid email. Please try again.', 5, type: 'error');

    if (!preg_match("/^[a-zA-Z_0-9]{8,}$/", $password)) generateDialogBox('signup', 'Your password must satisfy:<br><br> a minimum of 8 characters<br> Special character allowed is underscore<br> Strictly no spaces.<br> Please try again.', 5, type: 'error');

    if ($password !== $confirm_password) generateDialogBox('signup', 'Your password and confirm password does not match.<br>Please try again.', 5, type: 'error');

    if ($repo->searchUser($email, ($name) ? 'moderator' : 'client')) generateDialogBox('signup', 'Email is taken. Please try again.', 5, type: 'error');
}

function validateLogin($params, $repo)
{
    extract($params);
    $table = ['http://has-precast.com' => 'account', 'http://admin.has-precast.com' => 'moderator'];
    $table = $table[$_SERVER['HTTP_ORIGIN']];

    foreach ($params as $key => $value) {
        if (empty($value)) {
            if ($table === 'account') generateDialogBox('login', 'Empty input is not allowed.<br>Please try again.', 5, type: 'error');
            else generateDialogBox('has-precast/admin-log-in.php', 'Empty input is not allowed.<br>Please try again.', 5, type: 'error', domain: 'admin.has-precast.com');
        }
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($table === 'account') generateDialogBox('login', 'Invalid email. Please try again.', 5, type: 'error');
        else generateDialogBox('has-precast/admin-log-in.php', 'Invalid email. Please try again.', 5, type: 'error', domain: 'admin.has-precast.com');
    }
}

function generateDialogBox($path, $message, $top, $right = '', $type = 'default', $domain = 'has-precast.com', $extra = '')
{
    $message = urlencode($message);
    header("Location: http://$domain/$path?message=$message&$extra&top=$top&right=$right&type=$type");
    exit;
}
