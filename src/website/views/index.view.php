<?php

include("classes/dbh.classes.php");
include("classes/content-repo.classes.php");

$getContent = new ContentRepository;

$page = 'home';

$heroImg = $getContent->getHeroForPage($page);
$items = count($heroImg);
$heroNumber = rand(0, ($items -= 1));

$randHero = $heroImg[$heroNumber]['object'];

$mediaExt = explode('.', $randHero);
$mediaActualExt = strtolower(end($mediaExt));

$hero = $getContent->getSection($page, "hero");
$wfb = $getContent->getSection($page, "wfb");
$projects = $getContent->getSection($page, "projects");
$contact = $getContent->getSection($page, "contact");
$img = $getContent->getImages($page);


if ($mediaActualExt === 'webm') {
  $heroMedia = "
    <section class='hero-section'>
      <video muted autoplay controls src='admin/has-precast/images/hero/home/{$randHero}'></video>
      <h1 class='hero-text'>{$hero[0]['object']}</h1>
      <div class='filter'></div>
    </section>
    ";
} else {
  $heroMedia = "
      <section class='hero-section' style='
      background-image: url(\"admin/has-precast/images/hero/home/{$randHero}\");
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      '>
          <h1 class='hero-text'>{$hero[0]['object']}</h1>
      </section>
    ";
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
  <link rel="stylesheet" href="/website/assets/styles/base/index.css">
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
    <?php
    echo $heroMedia;
    ?>
    <section class="wall-form-blocks-section" style="background: url('admin/has-precast/images/index/<?php echo $img[0]['object']; ?>'); background-repeat: no-repeat; background-size: cover; ">
      <h1><?php echo $wfb[0]['object']; ?></h1>
      <h1><?php echo $wfb[1]['object']; ?></h1>
      <div class="button">
        <a href="wall-form-blocks">
          <div class="up"><?php echo $wfb[2]['object']; ?></div>
          <div class="down"><?php echo $wfb[2]['object']; ?></div>
        </a>
      </div>
    </section>
    <section class="projects-section">
      <h1><?php echo $projects[0]['object']; ?></h1>
      <div class="project-view">
        <div class="project" style="background-image: url('admin/has-precast/images/index/<?php echo $img[1]['object']; ?>');">
          <h1><?php echo $projects[1]['object']; ?></h1>
          <div class="button-wrapper">
            <div class="button"><a href="/projects">
                <div class="up"><?php echo $projects[5]['object']; ?></div>
                <div class="down"><?php echo $projects[5]['object']; ?></div>
              </a>
            </div>
          </div>
        </div>
        <div class="project" style="background-image: url('admin/has-precast/images/index/<?php echo $img[2]['object']; ?>');">
          <h1><?php echo $projects[2]['object']; ?></h1>
          <div class="button-wrapper">
            <div class="button"><a href="/projects">
                <div class="up"><?php echo $projects[6]['object']; ?></div>
                <div class="down"><?php echo $projects[6]['object']; ?></div>
              </a>
            </div>
          </div>
        </div>
        <div class="project" style="background-image: url('admin/has-precast/images/index/<?php echo $img[3]['object']; ?>');">
          <h1><?php echo $projects[3]['object']; ?></h1>
          <div class="button-wrapper">
            <div class="button"><a href="/projects">
                <div class="up"><?php echo $projects[7]['object']; ?></div>
                <div class="down"><?php echo $projects[7]['object']; ?></div>
              </a>
            </div>
          </div>
        </div>
        <div class="project" style="background-image: url('admin/has-precast/images/index/<?php echo $img[4]['object']; ?>');">
          <h1><?php echo $projects[4]['object']; ?></h1>
          <div class="button-wrapper">
            <div class="button"><a href="/projects">
                <div class="up"><?php echo $projects[8]['object']; ?></div>
                <div class="down"><?php echo $projects[8]['object']; ?></div>
              </a>
            </div>
          </div>
        </div>
        <div class="background"></div>
      </div>
    </section>
    <section class="contact-section" style="background: url('admin/has-precast/images/index/<?php echo $img[5]['object']; ?>');">
      <h1><?php echo $contact[0]['object']; ?></h1>
      <div class="button">
        <a href="contact-us">
          <div class="up"><?php echo $contact[1]['object']; ?></div>
          <div class="down"><?php echo $contact[1]['object']; ?></div>
        </a>
      </div>
    </section>


    <!-- includes HTML for footer -->
    <?php require 'partials/footer.php' ?>
  </div>
</body>

</html>