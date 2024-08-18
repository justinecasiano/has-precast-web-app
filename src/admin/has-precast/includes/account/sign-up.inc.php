<?php
    


if(isset($_POST["submit"])){

    // Grabs Data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    
    // Run Controller Class
    include ("../../classes/dbh.classes.php");
    include ("../../classes/client-account-repo.php");
    include ("../../classes/signup-ctrl.classes.php");

    $signup = new SignupContr($first_name, $last_name, $email, $password, $confirm_password);

    
    // Handles errors and User Signup
    $signup->signupUser();


    // Goes back to Signup Form
    header("location: ../../client-sign-up.php?error=none");

}