<?php

include("../../classes/dbh.classes.php");
include("../../classes/admin-account-repo.php");

$Delete = new AccountRepository;

$Delete->DeleteEditor();

header("location: ../../account-management-editor.php?error=none");

    


