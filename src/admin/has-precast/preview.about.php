<?php
  session_start();

  if(!isset($_POST['submit'])){
    header("location: ../has-precast/content-management-about.php");
  }

  require("includes/image-handler.php");
  
  $hero_title1 = $_POST['hero-TITLE1'];
  $hero_caption1 = $_POST['hero-CAPTION1'];
  $hero_button = $_POST['hero-BUTTON'];

  $about_title1 = $_POST["about-TITLE1"];
  
  $about_paragraph1 = $_POST["about-PARAGRAPH1"];
  $about_paragraph2 = $_POST["about-PARAGRAPH2"];
  $about_paragraph3 = $_POST["about-PARAGRAPH3"];
  $about_paragraph4 = $_POST["about-PARAGRAPH4"];
  $about_paragraph5 = $_POST["about-PARAGRAPH5"];

  if(!empty($_FILES['about-IMAGE1']['name'])){
    $about_image1 = $_FILES["about-IMAGE1"];

    $abt1 = imageHandler3($about_image1, "about-us", "about-temp");
  }
  else{
    $abt1['newName'] = $_POST["about-img1"];
    $abt1['destination'] = "images/temp/about-us/".$abt1['newName'];
  }

  $mv_title1 = $_POST["mv-TITLE1"];

  $mv_subtitle1 = $_POST["mv-SUBTITLE1"];
  $mv_paragraph1 = $_POST["mv-PARAGRAPH1"];
  
  $mv_subtitle2 = $_POST["mv-SUBTITLE2"];
  $mv_paragraph2 = $_POST["mv-PARAGRAPH2"];

  if(!empty($_FILES['mv-IMAGE1']['name'])){
    $mv_image1 = $_FILES["mv-IMAGE1"];

    $mv1 = imageHandler3($mv_image1, "about-us", "mv_background-temp");
  }
  else{
    $mv1['newName'] = $_POST["mv-img1"];
    $mv1['destination'] = "images/temp/about-us/".$mv1['newName'];
  }


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About us</title>

  <!-- includes fonts, stylesheets and site icon used -->
  <?php require 'partials/head.php' ?>

  <!-- link stylesheet for about-us HTML -->
  <link rel="stylesheet" href="styles/base/about-us.css">
</head>

<body>
  <!-- includes HTML for navigation -->
  <?php require 'partials/navigation.php' ?>

  <!-- includes HTML for sidebar -->
  <?php require 'partials/sidebar.php' ?>

  <!-- main content starts here -->
  <section class="about-us-hero-section" style="background-image: url('images/about-us/about-us-hero.webp')">
    <div>
      <h1><?php echo $hero_title1; ?></h1>
      <p><?php echo $hero_caption1; ?></p>
      <a href="about-us#about-us-content-wrapper"><button><?php echo $hero_button; ?></button></a>
    </div>
  </section>

  <section id="about-us-content-wrapper">
    <h1><?php echo $about_title1; ?></h1>

    <div>
      <div>
        <?php
          echo "
            <p>
              $about_paragraph1
              <br><br>
              $about_paragraph2
              <br><br>
              $about_paragraph3
              <br><br>
              $about_paragraph4
              <br><br>
              $about_paragraph5
            </p>
          ";
        ?>
      </div>
      <div>
        <img src="<?php echo $abt1['destination'];?>">
      </div>
    </div>
  </section>

  <section class="mission-vision" style="<?php echo "background-image: url('{$mv1['destination']}?>')"; ?>">
    <h1><?php echo $mv_title1; ?></h1>

    <div>
      <div>
        <h1><?php echo $mv_subtitle1; ?></h1>
        <p><?php echo $mv_paragraph1; ?></p>
      </div>
      <div>
        <h1><?php echo $mv_subtitle2; ?></h1>
        <p><?php echo $mv_paragraph2; ?></p>
      </div>
    </div>
    
    <form action="includes/content/edit-content.inc.php?page=about" method="post">
      <input type="hidden" name="hero-TITLE1" value="<?php echo $hero_title1; ?>">
      <input type="hidden" name="hero-CAPTION1" value="<?php echo $hero_caption1; ?>">
      <input type="hidden" name="hero-BUTTON" value="<?php echo $hero_button; ?>">
      <input type="hidden" name="about-TITLE1" value="<?php echo $about_title1; ?>">
      <input type="hidden" name="about-PARAGRAPH1" value="<?php echo $about_paragraph1; ?>">
      <input type="hidden" name="about-PARAGRAPH2" value="<?php echo $about_paragraph2; ?>">
      <input type="hidden" name="about-PARAGRAPH3" value="<?php echo $about_paragraph3; ?>">
      <input type="hidden" name="about-PARAGRAPH4" value="<?php echo $about_paragraph4; ?>">
      <input type="hidden" name="about-PARAGRAPH5" value="<?php echo $about_paragraph5; ?>">
      <input type="hidden" name="about-IMAGE1" value="<?php echo $abt1['destination']; ?>">
      <input type="hidden" name="mv-TITLE1" value="<?php echo $mv_title1; ?>">
      <input type="hidden" name="mv-SUBTITLE1" value="<?php echo $mv_subtitle1; ?>">
      <input type="hidden" name="mv-PARAGRAPH1" value="<?php echo $mv_paragraph1; ?>">
      <input type="hidden" name="mv-SUBTITLE2" value="<?php echo $mv_subtitle2; ?>">
      <input type="hidden" name="mv-PARAGRAPH2" value="<?php echo $mv_paragraph2; ?>">
      <input type="hidden" name="mv-IMAGE1" value="<?php echo $mv1['destination']; ?>">

      
      <div class="button">
        <button type="submit" name="submit" class="submit">SAVE</button>
      </div>
    </form>
    <div class="button-cancel">
      <a href="content-management-about.php"><button class="cancel">CANCEL</button></a>
    </div>
    
  </section>
  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>