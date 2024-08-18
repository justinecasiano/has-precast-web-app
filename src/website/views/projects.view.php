
<?php

  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");
  
  $getContent = new ContentRepository;

  $page = 'projects';

  $heroImg = $getContent->getHeroForPage($page);
  $items = count($heroImg);
  $heroNumber = rand(0, ($items-= 1));

  $randHero = $heroImg[$heroNumber]['object'];

  $hero = $getContent->getSection($page, "hero");
  $projects_Content = $getContent->getSection($page, "projects");

  $projects = $getContent->getProjectsPage("projects");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Projects</title>

  <!-- includes fonts, stylesheets and site icon used -->
  <?php require 'partials/head.php' ?>

  <!-- link stylesheet for projects HTML -->
  <link rel="stylesheet" href="/website/assets/styles/base/projects.css">
</head>

<body>
  <!-- includes HTML for navigation -->
  <?php require 'partials/navigation.php' ?>

  <!-- includes HTML for sidebar -->
  <?php require 'partials/sidebar.php' ?>

  <!-- main content starts here -->
  <section class="projects-hero-section" style="background-image: url('admin/has-precast/images/hero/projects/<?php echo $randHero; ?>');">
    <div>
      <h1><?php echo $hero[0]['object'];  ?></h1>
      <p><?php echo $hero[1]['object'];  ?></p>
      <a href="projects#projects-wrapper"><button><?php echo $hero[2]['object'];  ?></button></a>
    </div>
  </section>

  <section id="projects-wrapper">
    <h1><?php echo $projects_Content[0]['object'];  ?></h1>

    <div>
      

      <?php
      foreach($projects as $project){
        echo "
        
          <div class='projects-card'>
            <div><img src='admin/has-precast/images/temp/projects/{$project['mainImage']}'></div>

            <div class='projects-description'>
              <div>
                <p>{$project['description']}</p>
                <h1>{$project['type']}</h1>
                <p>{$project['location']}</p>
              </div>
              <div><img src='admin/has-precast/images/temp/projects/{$project['icon']}'></div>
            </div>
            <div class='tooltip'>
              <img src='admin/has-precast/images/temp/projects/{$project['subImage1']}'>
              <img src='admin/has-precast/images/temp/projects/{$project['subImage2']}'>
              </div>
            </div>
        
        ";
      }
      ?>

      
  </section>
  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>