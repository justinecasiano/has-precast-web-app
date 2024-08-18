<?php
    


if(isset($_POST["submit"])){

    // Grabs Data
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Run Controller Class
    include ("../../classes/dbh.classes.php");
    include ("../../classes/client-account-repo.php");
    include ("../../classes/login-ctrl.classes.php");

    $login = new LoginContr($email, $password);

    
    // Handles errors and User Login
    $login->loginUser();


    // Goes to homepage
    header("location: ../../index.php?error=none");
}