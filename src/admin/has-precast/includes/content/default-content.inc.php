<?php

if(isset($_GET['type'])){
    include("../../classes/dbh.classes.php");
    include("../../classes/default-repo.php");

    $default = new DefaultRepository;

    $result = $default->getDefaultHero();

    $default->setToDefaultHero($result);

    $message = urlencode('Hero Images has been Successfully Reset!');
    header("location: ../../content-management-hero.php?message={$message}&top=10&type=success");
    exit();
}

if($_GET['page'] === "products"){
    include("../../classes/dbh.classes.php");
    include("../../classes/default-repo.php");

    $default = new DefaultRepository;

    $result = $default->getDefaultProducts();

    $default->setToDefaultProducts($result);

    $message = urlencode('Products has been Successfully Reset!');
    header("location: ../../content-management-products.php?message={$message}&top=10&type=success");
    exit();
}

if(isset($_GET['name'])){
    include("../../classes/dbh.classes.php");
    include("../../classes/default-repo.php");

    $default = new DefaultRepository;

    $result = $default->getDefaultObject($_GET['page'], $_GET['section'], $_GET['name']);
    $page = $_GET['page'];
    $section = $_GET['section'];
    $object = $_GET['name'];
    if($page === "userGuide"){
        $page = "user-guide";
    }
    $default->setToDefault($result);
    
    $message = urlencode(ucfirst(strtolower($object)) .' of '. ucfirst($page).' Page&#39;s ' . ucfirst(strtolower($section)) .' Section '.' has been Successfully Reset!');
    header("location: ../../content-management-{$page}.php?message={$message}&top=10&type=success");
    exit();
}

if(isset($_GET['page']) && $_GET['page'] !== "projects"){
    include("../../classes/dbh.classes.php");
    include("../../classes/default-repo.php");

    $default = new DefaultRepository;

    if($_GET['page'] === 'projectsContents'){
        $page = 'projects';
    }
    else{
        $page = $_GET['page'];
    }
    $result = $default->getDefault($page);

    $default->setToDefault($result);

    if($page === 'projects'){
        $page = 'projects';
    }
    elseif($page === 'userGuide'){
        $page = 'user-guide';
    }
    else{
        $page = $result[0]['page'];
    }

    $page = strtolower($page);

    $message = urlencode(ucfirst($page).' Page has been Successfully Reset!');
    header("location: ../../content-management-{$page}.php?page{$page}=&message={$message}&top=10&type=success");
    exit();
}

if($_GET['page'] == 'projects'){
    include("../../classes/dbh.classes.php");
    include("../../classes/default-repo.php");

    $default = new DefaultRepository;

    $result = $default->getDefaultProjects();

    $default->setToDefaultProjects($result);

    $message = urlencode('Cards of Project Page has been Successfully Reset!');
    header("location: ../../content-management-projects.php?message={$message}&top=10&type=success");
    exit();
}




