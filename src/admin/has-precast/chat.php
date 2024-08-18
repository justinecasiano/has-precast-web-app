<?php
session_start();

$_SESSION["current"] = "chat";
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
  <script defer src="scripts/global.js"></script>
  <script defer src="scripts/chat.js"></script>

  <link rel="stylesheet" href="styles/admin-global.css">
  <link rel="stylesheet" href="styles/chat.css">
  <!-- Insert webpage specific stylesheets here -->

</head>

<body>

  <?php
  include("includes/admin-editor-header-sidebar.php");
  ?>
  <div class="main-container">
    <section class="chat-wrapper">
      <div class="order-tab">
        <h1 class="order-heading">Loading data</h1>
        <div class="order-contents"></div>
      </div>
      <div class="chat-contents"></div>
    </section>
  </div>
</body>

</html>