
<?php

  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");
  
  $getContent = new ContentRepository;

  $page = 'CONTACT';

  $heroImg = $getContent->getHeroForPage($page);
  $items = count($heroImg);
  $heroNumber = rand(0, ($items-= 1));

  $randHero = $heroImg[$heroNumber]['object'];

  $hero = $getContent->getSection($page, "hero");
  $contacts = $getContent->getSection($page, "contacts");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact us</title>

  <!-- includes fonts, stylesheets and site icon used -->
  <?php require 'partials/head.php' ?>

  <!-- link stylesheet for contact-us HTML -->
  <link rel="stylesheet" href="/website/assets/styles/base/contact-us.css">
</head>

<body>
  <!-- includes HTML for navigation -->
  <?php require 'partials/navigation.php' ?>

  <!-- includes HTML for sidebar -->
  <?php require 'partials/sidebar.php' ?>

  <!-- main content starts here -->
  <section class="contact-us-section-1" style="background: url('admin/has-precast/images/hero/contact/<?php echo $randHero;?>'); background-size: cover;
  background-repeat: no-repeat;
  background-position: center;">
    <h1><?php echo $hero[0]['object']; ?></h1>
  </section>

  <section class="contact-us-section-2">
    <div class="map">
      <?php echo $contacts[0]['object']; ?>
    </div>
    <div class="contacts">
      <h2><?php echo $contacts[1]['object']; ?></h2>
      <h2><?php echo $contacts[2]['object']; ?></h2>
      <h2><?php echo $contacts[3]['object']; ?></h2>
      <h2><?php echo $contacts[4]['object']; ?></h2>
    </div>

  </section>
  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>