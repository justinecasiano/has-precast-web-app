<?php

include("../../classes/dbh.classes.php");
include("../../classes/admin-account-repo.php");

$Delete = new AccountRepository;

$Delete->SuspendEditor();

header("location: ../../account-management-editor.php?error=none");

    
$name = $_GET['name'];

if($_GET['status'] === "ACTIVE"){
    $update = "Suspended";
}
else{
    $update = "Unsuspended";
}

$message = urlencode('Editor &#34;'. $name .'&#34; has been '. $update.'!');
    header("location: ../../../has-precast/account-management-editor.php?message={$message}&top=10&type=success");
    exit();

