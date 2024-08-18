<?php
  if(!isset($_POST['submit'])){
    header("location: content-management-hero.php");
    exit();
  }

  if($_POST['submit'] === 'cancel'){
    header("location: content-management-hero.php");
    exit();
  }
  
  require("includes/image-handler.php");
  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");

  $getContent = new ContentRepository;



  if(
    !isset($_POST['name']) ||
    !isset($_POST['page']) ||
    empty($_FILES['object']['name'])
    ){
        $message = urlencode('Complete the Form Field to Upload New Hero Images!');
        header("location: content-management-hero.php?message={$message}&top=10&type=error");
        exit();
    }

  $name = $_POST['name'];
  $page = $_POST['page'];
  $object = $_FILES['object'];

  $check = $getContent->checkHero($name);
  
        
  $hero = fileHandler($object, "$page", "{$name}-temp");

  $img = array('jpg', 'png', 'jpeg');
  

  $content = $getContent->getSection($page, 'hero');


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>H&As' Precast Wall Form Blocks</title>

  <!-- includes fonts, stylesheets and site icon used -->
  <?php require 'partials/head.php' ?>

  <!-- link stylesheet for index HTML -->
  <?php
    switch($page){
        case 'home':
            echo"<link rel='stylesheet' href='styles/base/index.css'>";
            break;
        case 'about':
            echo"<link rel='stylesheet' href='styles/base/about-us.css'>";
            break;
        case 'wfb':
            echo"<link rel='stylesheet' href='styles/base/wall-form-blocks2.css'>";
            break;
        case 'userGuide':
            echo"<link rel='stylesheet' href='styles/base/user-guide.css'>";
            break;
        case 'projects':
            echo"<link rel='stylesheet' href='styles/base/projects.css'>";
            break;
        case 'contact':
            echo "<link rel='stylesheet' href='styles/base/contact-us.css'>";
            break;
    }
  ?>
  <link rel="stylesheet" href="styles/hero.css">
</head>

<body>
  <!-- wrapper for preloader -->
  <div class="wrapper">

    <!-- includes HTML for sidebar -->
    <?php require 'partials/sidebar.php' ?>

    <!-- includes HTML for preloader -->

    <!-- link script for running preloader once -->

    <!-- includes HTML for navigation -->
    <?php require 'partials/navigation.php' ?>

    <!-- main content starts here -->

    <?php

        switch($page){
            case 'home':
                echo"
                    <section class='hero-section' style='
                    background-image: url(\"images/hero/home/{$hero['newName']}\");
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: cover;
                    '>
                        <h1 class='hero-text'>{$content[0]['object']}</h1>
                    </section>
                ";
                break;
            case 'about':
                echo"
                    <section class='about-us-hero-section' style='background-image: url(\"images/hero/about/{$hero['newName']}\");'>
                        <div>
                            <h1>{$content[2]['object']}</h1>
                            <p>{$content[1]['object']}</p>
                            <a href='/'><button>{$content[0]['object']}</button></a>
                        </div>
                    </section>
                ";
                break;
            case 'wfb':
                echo"
                    <section class='hero-section' style='background-image: url(\"images/hero/wfb/{$hero['newName']}\");'>
                        <div>
                            <h1 class='hero-head'>{$content[2]['object']}</h1>
                            <p>{$content[1]['object']}</p>
                            <a href='about-us#about-us-content-wrapper'><button>{$content[0]['object']}</button></a>
                        </div>
                    </section>
                ";
                break;
            case 'userGuide':
                echo"
                    <section class='users-guide-hero-section' style='background-image: url(\"images/hero/userGuide/{$hero['newName']}\");'>
                        <div>
                            <h1 class='hero'>{$content[2]['object']}</h1>
                            <p>{$content[1]['object']}</p>
                            <a href='users-guide#pre-content'><button>{$content[0]['object']}</button></a>
                        </div>
                    </section>
                ";
                break;
            case 'projects':
                echo"
                    <section class='projects-hero-section' style='background: url(\"images/hero/projects/{$hero['newName']}\");'>
                        <div>
                            <h1>{$content[2]['object']}</h1>
                            <p>{$content[1]['object']}</p>
                            <a href='projects#projects-wrapper'><button>{$content[0]['object']}</button></a>
                        </div>
                    </section>
                ";
                break;
            case 'contact':
                echo "
                    <section class='contact-us-section-1' style='background: url(\"images/hero/contact/{$hero['newName']}\");'>
                        <h1>{$content[0]['object']}</h1>
                    </section>
                ";
                break;
        }

    ?>

    

    

    

    

    

    



    <form action="includes/content/add-hero.inc.php" method="post">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <input type="hidden" name="object" value="<?php echo $hero['destination']; ?>">

      <div class="button">
        <button type="submit" name="submit" class="submit">SAVE</button>
      </div>
    </form>
    <div class="button-cancel">
      <a href="content-management-hero.php"><button class="cancel">CANCEL</button></a>
    </div>

    <!-- includes HTML for footer -->
    <?php require 'partials/footer.php' ?>
  </div>
</body>

</html>