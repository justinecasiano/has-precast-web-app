<?php

if(isset($_POST['submit'])){

    include("../../classes/dbh.classes.php");
    include("../../classes/content-repo.classes.php");

    $setContents = new ContentRepository;

    include("../../classes/default-repo.php");

    require('../image-handler.php');

    $name = $_POST['name'];
    $page = $_POST['page'];

    $img = $_POST['object'];
    $hero = heroCopy1($img, $page, $name);


    $setContents->addHero($name, $page, $hero);

    $message = urlencode('New Hero Image &#34;'. $name . '&#34; has been Added to '. ucfirst($page).' Page');
    header("location: ../../../has-precast/content-management-hero.php?message={$message}&top=10&type=success");
    exit();
}
else{
    header("location: ../../../has-precast/content-management-hero.php");
}