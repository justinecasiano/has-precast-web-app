<?php

include("../../classes/dbh.classes.php");
include("../../classes/client-account-repo.php");

$Delete = new AccountRepository;

$Delete->StatusClient();

header("location: ../../account-management-client.php?error=none");

$name = $_GET['name'];

if($_GET['status'] === "ACTIVE"){
    $update = "Suspended";
}
else{
    $update = "Unsuspended";
}

$message = urlencode('Client &#34;'. $name .'&#34; has been '. $update.'!');
    header("location: ../../../has-precast/account-management-client.php?message={$message}&top=10&type=success");
    exit();



