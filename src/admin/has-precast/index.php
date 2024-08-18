<?php
session_start();
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
  <link rel="stylesheet" href="styles/global.css">
  <!-- Insert webpage specific stylesheets here -->

</head>

<body>
  <header>
    <div class="logo-container"><a href="/"><img src="images/logo-resized.png" alt="Logo"></a></div>
    <nav>
      <ul class="navbar-links">
        <li><a href="/">Home</a></li>
        <li><a href="about-us.html">About us</a></li>
        <li><a href="wall-form-blocks.html">Wall Form Blocks</a></li>
        <li><a href="users-guide.html">User Guide</a></li>
        <li><a href="projects.html">Projects</a></li>
        <li><a href="contact-us.html">Contact us</a></li>
        <?php
        if (isset($_SESSION["userAccountType"])) {
          if ($_SESSION["userAccountType"] == "Editor") {
            header("location: content-management.php?error=none");
          }
          if ($_SESSION["userAccountType"] == "Admin") {
            header("location: admin-index.php?error=none");
          }
        } else {
          header("Location: admin-log-in.php");
        }
        ?>
      </ul>
    </nav>
  </header>

  <!-- Put your code here, make use of sections 
    as it spans the whole viewport (full screen) -->
  <section>
    <h1 class="hero" style="font: 800 var(--fs-heading)/1em var(--ff-default)">Precast<br>Wall Form<br>Blocks</h1>
  </section>

  <footer>
    <div><a href="/"><img src="" alt="H&As' Logo"></a></div>
  </footer>
</body>

</html>