<?php
  session_start();

  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");
  
  $getContent = new ContentRepository;

  $page = 'about';

  $heroImg = $getContent->getHeroForPage($page);
  $items = count($heroImg);
  $heroNumber = rand(0, ($items-= 1));

  $randHero = $heroImg[$heroNumber]['object'];

  $hero = $getContent->getSection($page, 'hero');
  $about = $getContent->getSection($page, "about");
  $mv = $getContent->getSection($page, "MISSIONVISION");
  $img = $getContent->getImages($page);

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
  <section class="about-us-hero-section" style="background-image: url('images/hero/about/<?php echo $randHero; ?>')">
    <div>
      <h1><?php echo $hero[0]['object']; ?></h1>
      <p><?php echo $hero[1]['object']; ?></p>
      <a href="about-us#about-us-content-wrapper"><button><?php echo $hero[2]['object']; ?></button></a>
    </div>
  </section>

  <section id="about-us-content-wrapper">
    <h1><?php echo $about[0]['object']; ?></h1>

    <div>
      <div>
        <?php
          echo "
            <p>
              {$about[1]['object']}
              <br><br>
              {$about[2]['object']}
              <br><br>
              {$about[3]['object']}
              <br><br>
              {$about[4]['object']}
              <br><br>
              {$about[5]['object']}
            </p>
          ";
        ?>
      </div>
      <div>
        <img src="images/temp/about-us/<?php echo $img[0]['object']; ?>">
      </div>
    </div>
  </section>

  <section class="mission-vision" style="<?php echo "background-image: url('images/temp/about-us/{$img[1]['object']}')"; ?>">
    <h1><?php echo $mv[0]['object']; ?></h1>

    <div>
      <div>
        <h1><?php echo $mv[1]['object']; ?></h1>
        <p><?php echo $mv[2]['object']; ?></p>
      </div>
      <div>
        <h1><?php echo $mv[3]['object']; ?></h1>
        <p><?php echo $mv[4]['object']; ?></p>
      </div>
    </div>
    
    
  </section>
  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>