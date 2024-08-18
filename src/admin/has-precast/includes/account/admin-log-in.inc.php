<?php
session_start();
if (isset($_GET['userid'])) {
    $_SESSION['userid'] = $_GET['userid'];
    $_SESSION['userAccountType'] = $_GET['userAccountType'];
}

if ($_GET['userAccountType'] === 'Editor') {
    header("location: ../content-management.php?error=none");
    exit;
} else {
    header("location: ../has-precast/admin-index.php?error=none");
    exit;
}

if (isset($_POST["submit"])) {

    // Grabs Data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Run Controller Class
    include("../../classes/dbh.classes.php");
    include("../../classes/admin-account-repo.php");
    include("../../classes/admin-login-ctrl.classes.php");

    $login = new AdminLoginContr($email, $password);


    // Handles errors and User Login
    $login->loginUser();
    // Goes to homepage
    if ($_SESSION["userAccountType"] == "Editor") {
        header("location: ../../content-management.php?error=none");
    }
    if ($_SESSION["userAccountType"] == "Admin") {
        header("location: ../../admin-index.php?error=none");
    }
}
