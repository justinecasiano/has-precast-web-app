<?php
session_start();
include("classes/dbh.classes.php");
include("classes/content-repo.classes.php");

if (!isset($_GET["page"])) {
  header("location: content-management.php?notSet");
}


$getContent = new ContentRepository;


switch ($_GET["page"]) {
  case "home":
    $page = "Homepage";
    break;
  case "about":
    $page = "About Us";
    break;
  case "wfb";
    $page = "Wall Form Blocks";
    break;
  case "userGuide":
    $page = "User Guide";
    break;
  case "projects":
    $_SESSION["current"] = "projects";
    $page = "Projects";
    break;
  case "projectsContent":
    $page = "Projects";
    break;
  case "contact":
    $page = "Contact Us";
    break;
  case "hero":
    $_SESSION["current"] = "hero";
    $page = "Hero";
    break;
  case "heroEdit":
    $page = "Hero";
    break;
  case "products":
    $_SESSION["current"] = "products";
    $page = "Products";
    break;
  case "productsEdit":
    $page = "Products";
    break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>H&As' Precast</title>

  <!-- Site icon here -->

  <!-- Fonts used are downloaded here -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- CSS stylesheets -->
  <link rel="stylesheet" href="styles/admin-global.css">
  <!-- Insert webpage specific stylesheets here -->
  <link rel="stylesheet" href="styles/content.css">

  <link rel="stylesheet" href="styles/add-editor.css">
</head>

<body>
  <?php
  include("includes/admin-editor-header-sidebar.php");
  ?>



  <main>
    <div class="main-header">
      <h1>Content Management - <?php echo $page; ?></h1>
    </div>

    <div class="table">

      <?php

      switch ($_GET["page"]) {
        case "home":
          $_SESSION["current"] = "home";
          include("includes/edit-content/edit-home-form.php");
          break;
        case "about":
          $_SESSION["current"] = "about";
          include("includes/edit-content/edit-about-form.php");
          break;
        case "wfb";
          $_SESSION["current"] = "wfb";
          include("includes/edit-content/edit-wfb-form.php");
          break;
        case "userGuide":
          $_SESSION["current"] = "user-guide";
          include("includes/edit-content/edit-user-guide-form.php");
          break;
        case "projects":
          $_SESSION["current"] = "projects";
          include("includes/edit-content/add-projects-form.php");
          break;
        case "projectsContent":
          $_SESSION["current"] = "projects";
          include("includes/edit-content/edit-projects-form.php");
          break;
        case "contact":
          $_SESSION["current"] = "contact";
          include("includes/edit-content/edit-contact-form.php");
          break;
        case "hero":
          $_SESSION["current"] = "hero";
          include('includes/edit-content/add-hero.php');
          break;
        case "heroEdit":
          $_SESSION["current"] = "hero";
          include('includes/edit-content/edit-hero.php');
          break;
        case "products":
          $_SESSION["current"] = "products";
          include('includes/edit-content/add-products-form.php');
          break;
        case "productsEdit":
          $_SESSION["current"] = "products";
          include('includes/edit-content/edit-products-form.php');
          break;
      }
      ?>
    </div>
  </main>
</body>

</html>