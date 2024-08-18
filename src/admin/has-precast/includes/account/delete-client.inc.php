<?php

include("../../classes/dbh.classes.php");
include("../../classes/client-account-repo.php");

$Delete = new AccountRepository;

$Delete->DeleteClient();

header("location: ../../account-management-client.php?error=none");

    


