<?php

session_start();

  if(!isset($_POST['submit'])){
    header("location: ../has-precast/content-management-user-guide.php");
  }

  require("includes/image-handler.php");

  $hero_title1 = $_POST['hero-TITLE1'];
  $hero_caption1 = $_POST['hero-CAPTION1'];
  $hero_button = $_POST['hero-BUTTON'];

  $pre_title1 = $_POST['pre-TITLE1'];
  $pre_paragraph1 = $_POST['pre-PARAGRAPH1'];
  $pre_paragraph2 = $_POST['pre-PARAGRAPH2'];

  $table_title1 = $_POST['table-TITLE1'];
  $table_content1 = $_POST['table-CONTENT1'];
  $table_content2 = $_POST['table-CONTENT2'];

  $ct1_TITLE1 = $_POST['ct1-TITLE1'];
  $ct1_STEP1 = $_POST['ct1-STEP1'];
  $ct1_PARAGRAPH1 = $_POST['ct1-PARAGRAPH1'];
  $ct1_STEP2 = $_POST['ct1-STEP2'];
  $ct1_PARAGRAPH2 = $_POST['ct1-PARAGRAPH2'];
  $ct1_STEP3 = $_POST['ct1-STEP3'];
  $ct1_PARAGRAPH3 = $_POST['ct1-PARAGRAPH3'];
  $ct1_STEP4 = $_POST['ct1-STEP4'];
  $ct1_PARAGRAPH4 = $_POST['ct1-PARAGRAPH4'];
  $ct1_STEP5 = $_POST['ct1-STEP5'];
  $ct1_PARAGRAPH5 = $_POST['ct1-PARAGRAPH5'];
  $ct1_STEP6 = $_POST['ct1-STEP6'];
  $ct1_PARAGRAPH6 = $_POST['ct1-PARAGRAPH6'];

  if(!empty($_FILES['ct1-IMAGE1']['name'])){
    $ct1_image1 = $_FILES["ct1-IMAGE1"];

    $step1 = imageHandler4($ct1_image1, "user-guide", "step1-temp");
  }
  else{
    $step1['newName'] = $_POST["ct1-img1"];
    $step1['destination'] = "images/user-guide/".$step1['newName'];
  }



  if(!empty($_FILES['ct1-IMAGE2']['name'])){
    $ct1_image2 = $_FILES["ct1-IMAGE2"];

    $step2 = imageHandler4($ct1_image2, "user-guide", "step2-temp");
  }
  else{
    $step2['newName'] = $_POST["ct1-img2"];
    $step2['destination'] = "images/user-guide/".$step2['newName'];
  }



  if(!empty($_FILES['ct1-IMAGE3']['name'])){
    $ct1_image3 = $_FILES["ct1-IMAGE3"];

    $step3 = imageHandler4($ct1_image3, "user-guide", "step3-temp");
  }
  else{
    $step3['newName'] = $_POST["ct1-img3"];
    $step3['destination'] = "images/user-guide/".$step3['newName'];
  }



  if(!empty($_FILES['ct1-IMAGE4']['name'])){
    $ct1_image4 = $_FILES["ct1-IMAGE4"];

    $step4 = imageHandler4($ct1_image4, "user-guide", "step4-temp");
  }
  else{
    $step4['newName'] = $_POST["ct1-img4"];
    $step4['destination'] = "images/user-guide/".$step4['newName'];
  }



  if(!empty($_FILES['ct1-IMAGE5']['name'])){
    $ct1_image5 = $_FILES["ct1-IMAGE5"];

    $step5 = imageHandler4($ct1_image5, "user-guide", "step5-temp");
  }
  else{
    $step5['newName'] = $_POST["ct1-img5"];
    $step5['destination'] = "images/user-guide/".$step5['newName'];
  }



  if(!empty($_FILES['ct1-IMAGE6']['name'])){
    $ct1_image6 = $_FILES["ct1-IMAGE6"];

    $step6 = imageHandler4($ct1_image6, "user-guide", "step6-temp");
  }
  else{
    $step6['newName'] = $_POST["ct1-img6"];
    $step6['destination'] = "images/user-guide/".$step6['newName'];
  }

  $ct2_TITLE1 = $_POST['ct2-TITLE1'];
  $ct2_STEP1 = $_POST['ct2-STEP1'];
  $ct2_PARAGRAPH1 = $_POST['ct2-PARAGRAPH1'];
  $ct2_STEP2 = $_POST['ct2-STEP2'];
  $ct2_PARAGRAPH2 = $_POST['ct2-PARAGRAPH2'];
  $ct2_STEP3 = $_POST['ct2-STEP3'];
  $ct2_PARAGRAPH3 = $_POST['ct2-PARAGRAPH3'];
  $ct2_STEP4 = $_POST['ct2-STEP4'];
  $ct2_PARAGRAPH4 = $_POST['ct2-PARAGRAPH4'];
  $ct2_STEP5 = $_POST['ct2-STEP5'];
  $ct2_PARAGRAPH5 = $_POST['ct2-PARAGRAPH5'];
  $ct2_STEP6 = $_POST['ct2-STEP6'];
  $ct2_PARAGRAPH6 = $_POST['ct2-PARAGRAPH6'];
  $ct2_STEP7 = $_POST['ct2-STEP7'];
  $ct2_PARAGRAPH7 = $_POST['ct2-PARAGRAPH7'];
  $ct2_NOTE = $_POST['ct2-NOTE'];

  if(!empty($_FILES['ct2-VIDEO1']['name'])){
    $ct2_video1 = $_FILES["ct2-VIDEO1"];

    $vid = videoHandler1($ct2_video1, "user-guide", "video-temp");
  }
  else{
    $vid['newName'] = $_POST["ct2-vid1"];
    $vid['destination'] = "videos/user-guide/".$vid['newName'];
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Guide</title>

  <!-- includes fonts, stylesheets and site icon used -->
  <?php require 'partials/head.php' ?>

  <!-- link stylesheet for user-guide HTML -->
  <link rel="stylesheet" href="styles/base/user-guide.css">
</head>

<body>
  <!-- includes HTML for navigation -->
  <?php require 'partials/navigation.php' ?>

  <!-- includes HTML for sidebar -->
  <?php require 'partials/sidebar.php' ?>

  <!-- main content starts here -->
  <section class="users-guide-hero-section" style="background-image: url('images/hero/userGuide/userHeroDefault.webp');">
    <div>
      <h1 class="hero"><?php echo $hero_title1; ?></h1>
      <p><?php echo $hero_caption1; ?></p>
      <a href="users-guide#pre-content"><button><?php echo $hero_button; ?></button></a>
    </div>
  </section>

  <section id="pre-content">
    <h1><?php echo $pre_title1; ?></h1>
    <p><?php echo $pre_paragraph1; ?>
      <br><br>
      <?php echo $pre_paragraph2; ?>
    </p>

    <h1><?php echo $table_title1; ?></h1>
    <ul>
      <li>
        <div>1</div><a href="user-guide#order-wfb"><?php echo $table_content1; ?></a>
      </li>
      <li>
        <div>2</div><a href="user-guide#install-wfb"><?php echo $table_content2; ?></a>
      </li>
    </ul>
  </section>

  <section id="order-wfb">
    <h1><?php echo $ct1_TITLE1; ?></h1>
    <div class="order-steps-wrapper">

      <div>
        <h1><?php echo $ct1_STEP1; ?></h1>
        <p><?php echo $ct1_PARAGRAPH1; ?></p>
      </div>
      <div>
        <img src="<?php echo $step1['destination']; ?>" alt="Step1">
      </div>

      <div>
        <h1><?php echo $ct1_STEP2; ?></h1>
        <p><?php echo $ct1_PARAGRAPH2; ?></p>
      </div>
      <div>
        <img src="<?php echo $step2['destination']; ?>" alt="Step2">
      </div>

      <div>
        <h1><?php echo $ct1_STEP3; ?></h1>
        <p><?php echo $ct1_PARAGRAPH3; ?></p>
      </div>
      <div>
        <img src="<?php echo $step3['destination']; ?>" alt="Step3">
      </div>

      <div>
        <h1><?php echo $ct1_STEP4; ?></h1>
        <p><?php echo $ct1_PARAGRAPH4; ?></p>
      </div>
      <div>
        <img src="<?php echo $step4['destination']; ?>" alt="Step4">
      </div>

      <div>
        <h1><?php echo $ct1_STEP5; ?></h1>
        <p><?php echo $ct1_PARAGRAPH5; ?></p>
      </div>
      <div>
        <img src="<?php echo $step5['destination']; ?>" alt="Step5">
      </div>

      <div>
        <h1><?php echo $ct1_STEP6; ?></h1>
        <p><?php echo $ct1_PARAGRAPH6; ?></p>
      </div>
      <div>
        <img src="<?php echo $step6['destination']; ?>" alt="Step6">
      </div>
    </div>
  </section>

  <section id="install-wfb">
    <h1><?php echo $ct2_TITLE1; ?></h1>

    <div class="install-steps-wrapper">
      <div>
        <h1><?php echo $ct2_STEP1; ?></h1>
        <p><?php echo $ct2_PARAGRAPH1; ?></p>

        <h1><?php echo $ct2_STEP2; ?></h1>
        <p><?php echo $ct2_PARAGRAPH2; ?></p>

        <h1><?php echo $ct2_STEP3; ?></h1>
        <p><?php echo $ct2_PARAGRAPH3; ?></p>

        <h1><?php echo $ct2_STEP4; ?></h1>
        <p><?php echo $ct2_PARAGRAPH4; ?></p>

        <h1><?php echo $ct2_STEP5; ?></h1>
        <p><?php echo $ct2_PARAGRAPH5; ?></p>

        <h1><?php echo $ct2_STEP6; ?></h1>
        <p><?php echo $ct2_PARAGRAPH6; ?></p>

        <h1><?php echo $ct2_STEP7; ?></h1>
        <p><?php echo $ct2_PARAGRAPH7; ?></p>

        <p><?php echo $ct2_NOTE; ?></p>
      </div>
      <div>
        <video src="../has-precast/<?php echo $vid['destination']; ?>" autoplay controls></video>
      </div>
    </div>



    <form action="includes/content/edit-content.inc.php?page=userGuide" method="post">
      <input type="hidden" name="hero-TITLE1" value="<?php echo $hero_title1; ?>">
      <input type="hidden" name="hero-CAPTION1" value="<?php echo $hero_caption1; ?>">
      <input type="hidden" name="hero-BUTTON" value="<?php echo $hero_button; ?>">

      <input type="hidden" name="pre-TITLE1" value="<?php echo $pre_title1; ?>">
      <input type="hidden" name="pre-PARAGRAPH1" value="<?php echo $pre_paragraph1; ?>">
      <input type="hidden" name="pre-PARAGRAPH2" value="<?php echo $pre_paragraph2; ?>">
      
      <input type="hidden" name="table-TITLE1" value="<?php echo $table_title1; ?>">
      <input type="hidden" name="table-CONTENT1" value="<?php echo $table_content1; ?>">
      <input type="hidden" name="table-CONTENT2" value="<?php echo $table_content2; ?>">
      
      <input type="hidden" name="ct1-TITLE1" value="<?php echo $ct1_TITLE1; ?>">
      <input type="hidden" name="ct1-STEP1" value="<?php echo $ct1_STEP1; ?>">
      <input type="hidden" name="ct1-PARAGRAPH1" value="<?php echo $ct1_PARAGRAPH1; ?>">
      <input type="hidden" name="ct1-IMAGE1" value="<?php echo $step1['destination']; ?>">
      <input type="hidden" name="ct1-STEP2" value="<?php echo $ct1_STEP2; ?>">
      <input type="hidden" name="ct1-PARAGRAPH2" value="<?php echo $ct1_PARAGRAPH2; ?>">
      <input type="hidden" name="ct1-IMAGE2" value="<?php echo $step2['destination']; ?>">
      <input type="hidden" name="ct1-STEP3" value="<?php echo $ct1_STEP3; ?>">
      <input type="hidden" name="ct1-PARAGRAPH3" value="<?php echo $ct1_PARAGRAPH3; ?>">
      <input type="hidden" name="ct1-IMAGE3" value="<?php echo $step3['destination']; ?>">
      <input type="hidden" name="ct1-STEP4" value="<?php echo $ct1_STEP4; ?>">
      <input type="hidden" name="ct1-PARAGRAPH4" value="<?php echo $ct1_PARAGRAPH4; ?>">
      <input type="hidden" name="ct1-IMAGE4" value="<?php echo $step4['destination']; ?>">
      <input type="hidden" name="ct1-STEP5" value="<?php echo $ct1_STEP5; ?>">
      <input type="hidden" name="ct1-PARAGRAPH5" value="<?php echo $ct1_PARAGRAPH5; ?>">
      <input type="hidden" name="ct1-IMAGE5" value="<?php echo $step5['destination']; ?>">
      <input type="hidden" name="ct1-STEP6" value="<?php echo $ct1_STEP6; ?>">
      <input type="hidden" name="ct1-PARAGRAPH6" value="<?php echo $ct1_PARAGRAPH6; ?>">
      <input type="hidden" name="ct1-IMAGE6" value="<?php echo $step6['destination']; ?>">
      
      <input type="hidden" name="ct2-TITLE1" value="<?php echo $ct2_TITLE1; ?>">
      <input type="hidden" name="ct2-STEP1" value="<?php echo $ct2_STEP1; ?>">
      <input type="hidden" name="ct2-PARAGRAPH1" value="<?php echo $ct2_PARAGRAPH1; ?>">
      <input type="hidden" name="ct2-STEP2" value="<?php echo $ct2_STEP2 ?>">
      <input type="hidden" name="ct2-PARAGRAPH2" value="<?php echo $ct2_PARAGRAPH2; ?>">
      <input type="hidden" name="ct2-STEP3" value="<?php echo $ct2_STEP3; ?>">
      <input type="hidden" name="ct2-PARAGRAPH3" value="<?php echo $ct2_PARAGRAPH3; ?>">
      <input type="hidden" name="ct2-STEP4" value="<?php echo $ct2_STEP4; ?>">
      <input type="hidden" name="ct2-PARAGRAPH4" value="<?php echo $ct2_PARAGRAPH4; ?>">
      <input type="hidden" name="ct2-STEP5" value="<?php echo $ct2_STEP5; ?>">
      <input type="hidden" name="ct2-PARAGRAPH5" value="<?php echo $ct2_PARAGRAPH5; ?>">
      <input type="hidden" name="ct2-STEP6" value="<?php echo $ct2_STEP6; ?>">
      <input type="hidden" name="ct2-PARAGRAPH6" value="<?php echo $ct2_PARAGRAPH6; ?>">
      <input type="hidden" name="ct2-STEP7" value="<?php echo $ct2_STEP7; ?>">
      <input type="hidden" name="ct2-PARAGRAPH7" value="<?php echo $ct2_PARAGRAPH7; ?>">

      <input type="hidden" name="ct2-NOTE" value="<?php echo $ct2_NOTE; ?>">
      <input type="hidden" name="ct2-VIDEO1" value="<?php echo $vid['destination']; ?>">
      
      <div class="button">
        <button type="submit" name="submit" class="submit">SAVE</button>
      </div>
    </form>
    <div class="button-cancel">
      <a href="content-management-user-guide.php"><button class="cancel">CANCEL</button></a>
    </div>
  </section>

  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>