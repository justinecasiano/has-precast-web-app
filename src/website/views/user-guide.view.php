<?php

  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");
  
  $getContent = new ContentRepository;

  $page = 'userGuide';

  $heroImg = $getContent->getHeroForPage($page);
  $items = count($heroImg);
  $heroNumber = rand(0, ($items-= 1));

  $randHero = $heroImg[$heroNumber]['object'];

  $hero = $getContent->getSection($page, "hero");
  $pre = $getContent->getSection($page, "precontent");
  $table = $getContent->getSection($page, "tablecontent");
  $ct1 = $getContent->getSection($page, "content1");
  $ct2 = $getContent->getSection($page, "content2");
  $img = $getContent->getImages($page);
  $video = $getContent->getVideos($page);

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
  <link rel="stylesheet" href="/website/assets/styles/base/user-guide.css">
</head>

<body>
  <!-- includes HTML for navigation -->
  <?php require 'partials/navigation.php' ?>

  <!-- includes HTML for sidebar -->
  <?php require 'partials/sidebar.php' ?>

  <!-- main content starts here -->
  <section class="users-guide-hero-section" style="background-image: url('admin/has-precast/images/hero/userGuide/<?php echo $randHero; ?>'); background-size: cover;
  background-repeat: no-repeat;
  background-position: center;">
    <div>
      <h1 class="hero"><?php echo $hero[0]['object']; ?></h1>
      <p class="hero-p"><?php echo $hero[1]['object']; ?></p>
      <a href="user-guide#pre-content"><button><?php echo $hero[2]['object']; ?></button></a>
    </div>
  </section>

  <section id="pre-content">
    <h1><?php echo $pre[0]['object']; ?></h1>
    <p><?php echo $pre[1]['object']; ?>
      <br><br>
      <?php echo $pre[2]['object']; ?>
    </p>

    <h1><?php echo $table[0]['object']; ?></h1>
    <ul>
      <li>
        <div>1</div><a href="user-guide#order-wfb"><?php echo $table[1]['object']; ?></a>
      </li>
      <li>
        <div>2</div><a href="user-guide#install-wfb"><?php echo $table[2]['object']; ?></a>
      </li>
    </ul>
  </section>

  <section id="order-wfb">
    <h1><?php echo $ct1[0]['object']; ?></h1>
    <div class="order-steps-wrapper">

      <div>
        <h1><?php echo $ct1[1]['object']; ?></h1>
        <p><?php echo $ct1[2]['object']; ?></p>
      </div>
      <div>
        <img src="admin/has-precast/images/user-guide/<?php echo $img[0]['object']; ?>" alt="Step1">
      </div>

      <div>
        <h1><?php echo $ct1[3]['object']; ?></h1>
        <p><?php echo $ct1[4]['object']; ?></p>
      </div>
      <div>
        <img src="admin/has-precast/images/user-guide/<?php echo $img[1]['object']; ?>" alt="Step2">
      </div>

      <div>
        <h1><?php echo $ct1[5]['object']; ?></h1>
        <p><?php echo $ct1[6]['object']; ?></p>
      </div>
      <div>
        <img src="admin/has-precast/images/user-guide/<?php echo $img[2]['object']; ?>" alt="Step3">
      </div>

      <div>
        <h1><?php echo $ct1[7]['object']; ?></h1>
        <p><?php echo $ct1[8]['object']; ?></p>
      </div>
      <div>
        <img src="admin/has-precast/images/user-guide/<?php echo $img[3]['object']; ?>" alt="Step4">
      </div>

      <div>
        <h1><?php echo $ct1[9]['object']; ?></h1>
        <p><?php echo $ct1[10]['object']; ?></p>
      </div>
      <div>
        <img src="admin/has-precast/images/user-guide/<?php echo $img[4]['object']; ?>" alt="Step5">
      </div>

      <div>
        <h1><?php echo $ct1[11]['object']; ?></h1>
        <p><?php echo $ct1[12]['object']; ?></p>
      </div>
      <div>
        <img src="admin/has-precast/images/user-guide/<?php echo $img[5]['object']; ?>" alt="Step6">
      </div>
    </div>
  </section>

  <section id="install-wfb">
    <h1><?php echo $ct2[0]['object']; ?></h1>

    <div class="install-steps-wrapper">
      <div>
        <h1><?php echo $ct2[1]['object']; ?></h1>
        <p><?php echo $ct2[2]['object']; ?></p>

        <h1><?php echo $ct2[3]['object']; ?></h1>
        <p><?php echo $ct2[4]['object']; ?></p>

        <h1><?php echo $ct2[5]['object']; ?></h1>
        <p><?php echo $ct2[6]['object']; ?></p>

        <h1><?php echo $ct2[7]['object']; ?></h1>
        <p><?php echo $ct2[8]['object']; ?></p>

        <h1><?php echo $ct2[9]['object']; ?></h1>
        <p><?php echo $ct2[10]['object']; ?></p>

        <h1><?php echo $ct2[11]['object']; ?></h1>
        <p><?php echo $ct2[12]['object']; ?></p>

        <h1><?php echo $ct2[13]['object']; ?></h1>
        <p><?php echo $ct2[14]['object']; ?></p>

        <p><?php echo $ct2[15]['object'];; ?></p>
      </div>
      <div>
        <video muted src="admin/has-precast/videos/user-guide/<?php echo $video[0]['object']; ?>" autoplay controls></video>
      </div>
    </div>
  </section>

  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>