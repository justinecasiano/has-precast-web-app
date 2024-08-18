<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $name = $_GET['name'];

    include("../../classes/dbh.classes.php");
    include("../../classes/content-repo.classes.php");

    $Delete = new ContentRepository;

    $Delete->deleteHeroUseID($id, $name);

    $message = urlencode('Hero Image '. $name .' Deleted Successfully');
    header("location: ../../content-management-hero.php?message={$message}&top=10&type=success");
    exit();
}