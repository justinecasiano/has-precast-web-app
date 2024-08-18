<?php
    
// Run Controller Class
include("../has-precast/classes/dbh.classes.php");
include("../has-precast/classes/admin-account-repo.php");

$getClient = new AccountRepository();

$result = $getClient->getClients();


