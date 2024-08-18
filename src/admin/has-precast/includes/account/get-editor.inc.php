<?php
    
// Run Controller Class
include("../has-precast/classes/dbh.classes.php");
include("../has-precast/classes/admin-account-repo.php");

$getEditor = new AccountRepository();

$result = $getEditor->getEditors();


