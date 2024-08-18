<?php
  if(isset($_POST['cancel']) || !isset($_POST['submit'])){
    header("location: content-management-home.php");
  }
  
  require("includes/image-handler.php");

  $hero_caption1 = $_POST['hero-CAPTION1'];

  $wfb_caption1 = $_POST['wfb-CAPTION1'];
  $wfb_caption2 = $_POST['wfb-CAPTION2'];
  $wfb_button = $_POST['wfb-BUTTON'];

  if(!empty($_FILES['wfb-IMAGE1']['name'])){
    $wfb_image1 = $_FILES["wfb-IMAGE1"];

    $wfb1 = imageHandler4($wfb_image1, "index", "wfb1Temp");
  }
  else{
    $wfb1['newName'] = $_POST["wfb-img1"];
    $wfb1['destination'] = "images/index/".$wfb1['newName'];
  }

  $prj_title1 = $_POST['prj-TITLE1'];
  $prj_caption1 = $_POST['prj-CAPTION1'];
  $prj_caption2 = $_POST['prj-CAPTION2'];
  $prj_caption3 = $_POST['prj-CAPTION3'];
  $prj_caption4 = $_POST['prj-CAPTION4'];
  $prj_button1 = $_POST['prj-BUTTON1'];
  $prj_button2 = $_POST['prj-BUTTON2'];
  $prj_button3 = $_POST['prj-BUTTON3'];
  $prj_button4 = $_POST['prj-BUTTON4'];

  if(!empty($_FILES['prj-IMAGE1']['name'])){
    $prj_image1 = $_FILES["prj-IMAGE1"];

    $prj1 = imageHandler4($prj_image1, "index", "prj1Temp");
  }
  else{
    $prj1['newName'] = $_POST["prj-img1"];
    $prj1['destination'] = "images/index/".$prj1['newName'];
  }



  if(!empty($_FILES['prj-IMAGE2']['name'])){
    $prj_image2 = $_FILES["prj-IMAGE2"];

    $prj2 = imageHandler4($prj_image2, "index", "prj2Temp");
  }
  else{
    $prj2['newName'] = $_POST["prj-img2"];
    $prj2['destination'] = "images/index/".$prj2['newName'];
  }



  if(!empty($_FILES['prj-IMAGE3']['name'])){
    $prj_image3 = $_FILES["prj-IMAGE3"];

    $prj3 = imageHandler4($prj_image3, "index", "prj3Temp");
  }
  else{
    $prj3['newName'] = $_POST["prj-img3"];
    $prj3['destination'] = "images/index/".$prj3['newName'];
  }



  if(!empty($_FILES['prj-IMAGE4']['name'])){
    $prj_image4 = $_FILES["prj-IMAGE4"];

    $prj4 = imageHandler4($prj_image4, "index", "prj4Temp");
  }
  else{
    $prj4['newName'] = $_POST["prj-img4"];
    $prj4['destination'] = "images/index/".$prj4['newName'];
  }


  $contact_caption1 = $_POST['contact-CAPTION1'];
  $contact_button1 = $_POST['contact-BUTTON1'];

  if(!empty($_FILES['contact-IMAGE1']['name'])){
    $contact_image1 = $_FILES["contact-IMAGE1"];

    $contact1 = imageHandler4($contact_image1, "index", "contact1Temp");
  }
  else{
    $contact1['newName'] = $_POST["contact-img1"];
    $contact1['destination'] = "images/index/".$contact1['newName'];
  }
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
  <link rel="stylesheet" href="styles/base/index.css">
</head>

<body>
  <!-- wrapper for preloader -->
  <div class="wrapper">

    <!-- includes HTML for sidebar -->
    <?php require 'partials/sidebar.php' ?>

    <!-- includes HTML for preloader -->
    <?php require 'partials/preloader.php' ?>

    <!-- link script for running preloader once -->
    <script src="/website/assets/scripts/preloader.js"></script>

    <!-- includes HTML for navigation -->
    <?php require 'partials/navigation.php' ?>

    <!-- main content starts here -->
    <section class="hero-section">
      <video muted autoplay controls src="https://res.cloudinary.com/dbx039gd1/video/upload/v1703882235/project-site.webm"></video>
      <h1 class="hero-text"><?php echo $hero_caption1; ?></h1>
      <div class="filter"></div>
    </section>
    <section class="wall-form-blocks-section" style="background: url('images/index/<?php echo $wfb1['newName']; ?>'); background-repeat: no-repeat; background-size: cover; ">
      <h1><?php echo $wfb_caption1; ?></h1>
      <h1><?php echo $wfb_caption2; ?></h1>
      <div class="button">
        <a href="wall-form-blocks">
          <div class="up"><?php echo $wfb_button; ?></div>
          <div class="down"><?php echo $wfb_button; ?></div>
        </a>
      </div>
    </section>
    <section class="projects-section">
      <h1><?php echo $prj_title1; ?></h1>
      <div class="project-view">
        <div class="project" style="background-image: url('images/index/<?php echo $prj1['newName']; ?>');">
          <h1><?php echo $prj_caption1; ?></h1>
          <div class="button-wrapper">
            <div class="button"><a href="/projects">
                <div class="up"><?php echo $prj_button1; ?></div>
                <div class="down"><?php echo $prj_button1; ?></div>
              </a>
            </div>
          </div>
        </div>
        <div class="project" style="background-image: url('images/index/<?php echo $prj2['newName']; ?>');">
          <h1><?php echo $prj_caption2; ?></h1>
          <div class="button-wrapper">
            <div class="button"><a href="/projects">
                <div class="up"><?php echo $prj_button2; ?></div>
                <div class="down"><?php echo $prj_button2; ?></div>
              </a>
            </div>
          </div>
        </div>
        <div class="project" style="background-image: url('images/index/<?php echo $prj3['newName']; ?>');">
          <h1><?php echo $prj_caption3; ?></h1>
          <div class="button-wrapper">
            <div class="button"><a href="/projects">
                <div class="up"><?php echo $prj_button3; ?></div>
                <div class="down"><?php echo $prj_button3; ?></div>
              </a>
            </div>
          </div>
        </div>
        <div class="project" style="background-image: url('images/index/<?php echo $prj4['newName']; ?>');">
          <h1><?php echo $prj_caption4; ?></h1>
          <div class="button-wrapper">
            <div class="button"><a href="/projects">
                <div class="up"><?php echo $prj_button4; ?></div>
                <div class="down"><?php echo $prj_button4; ?></div>
              </a>
            </div>
          </div>
        </div>
        <div class="background"></div>
      </div>
    </section>
    <section class="contact-section" style="background: url('images/index/<?php echo $contact1['newName']; ?>');">
      <h1><?php echo $contact_caption1; ?></h1>
      <div class="button">
        <a href="contact-us">
          <div class="up"><?php echo $contact_button1; ?></div>
          <div class="down"><?php echo $contact_button1; ?></div>
        </a>
      </div>
    </section>

    <form action="includes/content/edit-content.inc.php?page=home" method="post">
      <input type="hidden" name="hero-CAPTION1" value="<?php echo $hero_caption1; ?>">
      <input type="hidden" name="wfb-CAPTION1" value="<?php echo $wfb_caption1; ?>">
      <input type="hidden" name="wfb-CAPTION2" value="<?php echo $wfb_caption2; ?>">
      <input type="hidden" name="wfb-IMAGE1" value="<?php echo $wfb1['destination']; ?>">
      <input type="hidden" name="wfb-BUTTON" value="<?php echo $wfb_button; ?>">
      <input type="hidden" name="prj-TITLE1" value="<?php echo $prj_title1; ?>">
      <input type="hidden" name="prj-CAPTION1" value="<?php echo $prj_caption1; ?>">
      <input type="hidden" name="prj-CAPTION2" value="<?php echo $prj_caption2; ?>">
      <input type="hidden" name="prj-CAPTION3" value="<?php echo $prj_caption3; ?>">
      <input type="hidden" name="prj-CAPTION4" value="<?php echo $prj_caption4; ?>">
      <input type="hidden" name="prj-BUTTON1" value="<?php echo $prj_button1; ?>">
      <input type="hidden" name="prj-BUTTON2" value="<?php echo $prj_button2; ?>">
      <input type="hidden" name="prj-BUTTON3" value="<?php echo $prj_button3; ?>">
      <input type="hidden" name="prj-BUTTON4" value="<?php echo $prj_button4; ?>">
      <input type="hidden" name="prj-IMAGE1" value="<?php echo $prj1['destination']; ?>">
      <input type="hidden" name="prj-IMAGE2" value="<?php echo $prj2['destination']; ?>">
      <input type="hidden" name="prj-IMAGE3" value="<?php echo $prj3['destination']; ?>">
      <input type="hidden" name="prj-IMAGE4" value="<?php echo $prj4['destination']; ?>">
      <input type="hidden" name="contact-CAPTION1" value="<?php echo $contact_caption1; ?>">
      <input type="hidden" name="contact-BUTTON1" value="<?php echo $contact_button1; ?>">
      <input type="hidden" name="contact-IMAGE1" value="<?php echo $contact1['destination']; ?>">


      <div class="submitbutton">
        <button type="submit" name="submit" class="submit">SAVE</button>
      </div>
    </form>
    <div class="submitbutton-cancel">
      <a href="content-management-home.php"><button class="cancel">CANCEL</button></a>
    </div>

    <!-- includes HTML for footer -->
    <?php require 'partials/footer.php' ?>
  </div>
</body>

</html>