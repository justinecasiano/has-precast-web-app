<?php
    if(!isset($_POST['submit'])){
        header("location: ../has-precast/content-management-contact.php");
    }

    $hero_title1 = $_POST['hero-TITLE1'];
    $contact_gmaps = $_POST['contact-GMAPSEMBED'];
    $contact_add = $_POST['contact-ADDRESS'];
    $contact_email = $_POST['contact-EMAIL'];
    $contact_no1= $_POST['contact-CONTACTNO1'];
    $contact_no2= $_POST['contact-CONTACTNO2'];
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
  <link rel="stylesheet" href="styles/base/contact-us.css">
</head>

<body>
  <!-- includes HTML for navigation -->
  <?php require 'partials/navigation.php' ?>

  <!-- includes HTML for sidebar -->
  <?php require 'partials/sidebar.php' ?>

  <!-- main content starts here -->
  <section class="contact-us-section-1" style="background: url('images/hero/contact/contactHeroDefault.png');">
    <h1><?php echo $hero_title1; ?></h1>
  </section>

  <section class="contact-us-section-2">
    <div class="map">
      <?php echo $contact_gmaps; ?>
    </div>
    <div class="contacts">
      <h2><?php echo $contact_add; ?></h2>
      <h2><?php echo $contact_email; ?></h2>
      <h2><?php echo $contact_no1; ?></h2>
      <h2><?php echo $contact_no2; ?></h2>
    </div>

    <form action="includes/content/edit-content.inc.php?page=contact" method="post">
      <input type="hidden" name="hero-TITLE1" value="<?php echo $hero_title1; ?>">
      <input type="hidden" name="contact-GMAPSEMBED" id="gmaps" value="<?php echo htmlspecialchars($contact_gmaps); ?>">
      <input type="hidden" name="contact-ADDRESS" value="<?php echo $contact_add; ?>">
      <input type="hidden" name="contact-EMAIL" value="<?php echo $contact_email; ?>">
      <input type="hidden" name="contact-CONTACTNO1" value="<?php echo $contact_no1; ?>">
      <input type="hidden" name="contact-CONTACTNO2" value="<?php echo $contact_no2; ?>">
      
      
      <div class="button">
        <button type="submit" name="submit" class="submit">SAVE</button>
      </div>
    </form>
    <div class="button-cancel">
      <a href="content-management-contact.php"><button value="cancel" type="submit" class="cancel">CANCEL</button></a>
    </div>

  </section>

  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>