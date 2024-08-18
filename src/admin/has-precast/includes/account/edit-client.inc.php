<?php
if (isset($_POST["submit"])) {

    // Grabs Data
    $AccountID = $_GET["AccountID"];
    $AccountType = $_POST["account_type"];

    // Run Controller Class
    include("../../classes/dbh.classes.php");
    include("../../classes/admin-account-repo.php");

    $name = $_GET['name'];


    $edit = new AccountRepository();


    // Handles errors and User Signup
    $edit->updateClient($AccountID, $AccountType);

    // Goes back to Signup Form
    $message = urlencode('Client &#34;' . $name . '&#34; has been Updated Successfully!');
    header("location: ../../../has-precast/account-management-client.php?message={$message}&top=10&type=success");
    exit();
} else {
    header("location: ../../account-management-client.php");
}
