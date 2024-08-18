<?php
session_start();

if (isset($_GET['userid'])) {
  $_SESSION['userid'] = $_GET['userid'];
  $_SESSION['userAccountType'] = $_GET['userAccountType'];
  $_SESSION["current"] = "dashboard";
}

if (isset($_SESSION['userAccountType'])) {
  if ($_SESSION['userAccountType'] === 'Admin') {
    header("location: /has-precast/admin-index.php?");
    exit;
  } else if ($_SESSION['userAccountType'] === 'Editor') {
    header("location: /has-precast/content-management-products.php");
    exit;
  }
} else {
  header("location: /has-precast/admin-log-in.php?");
  exit;
}
include("classes/dbh.classes.php");
include("classes/content-repo.classes.php");
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
  <link rel="stylesheet" href="styles/table.css">

  <script defer src="scripts/global.js"></script>

</head>

<body>
  <?php
  include("includes/admin-editor-header-sidebar.php");

  $page = $_GET['page'];

  switch ($page) {
    case 'products':

      break;
    case 'hero':
      include('includes/cms-components/hero.php');
      break;
    case 'home':

      break;
    case 'about':

      break;
    case 'wfb':

      break;
    case 'user-guide':

      break;
    case 'projects':

      break;
    case 'contact':

      break;
  }



  ?>

</body>

</html>