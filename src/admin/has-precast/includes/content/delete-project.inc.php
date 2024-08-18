<?php

if(isset($_GET['cardID'])){
    $cardID = $_GET['cardID'];
    $name = $_GET['name'];

    include("../../classes/dbh.classes.php");
    include("../../classes/content-repo.classes.php");

    $Delete = new ContentRepository;

    $Delete->deleteProjectUseID($cardID, $name);

    header("location: ../../content-management-projects.php?deleyedSuccessfullys");
}