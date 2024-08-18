<?php
  if(!isset($_POST['submit'])){
    header("location: ../has-precast/content-management-projects.php");
  }

  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");

  require("includes/image-handler.php");

  $getContent = new ContentRepository;

  $hero_TITLE1 = $_POST['hero-TITLE1'];
  $hero_CAPTION1 = $_POST['hero-CAPTION1'];
  $hero_BUTTON = $_POST['hero-BUTTON'];
  $prj_TITLE1 = $_POST['prj-TITLE1'];

  $projectContents = $getContent->getPage("projects");
  

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
  <link rel="stylesheet" href="styles/base/projects.css">
</head>

<body>
  <!-- includes HTML for navigation -->
  <?php require 'partials/navigation.php' ?>

  <!-- includes HTML for sidebar -->
  <?php require 'partials/sidebar.php' ?>

  <!-- main content starts here -->
  <section class="projects-hero-section" style="background-image: url('images/hero/projects/projectsHeroDefault.webp');">
    <div>
      <h1><?php echo $hero_TITLE1;  ?></h1>
      <p><?php echo $hero_CAPTION1;  ?></p>
      <a href="projects#projects-wrapper"><button><?php echo $hero_BUTTON;  ?></button></a>
    </div>
  </section>

  <section id="projects-wrapper">
    <h1><?php echo $prj_TITLE1;  ?></h1>

    <div>
      

      <?php
      foreach($projects as $project){
        echo "
        
          <div class='projects-card'>
            <div><img src='images/temp/projects/{$project['mainImage']}'></div>

            <div class='projects-description'>
              <div>
                <p>{$project['description']}</p>
                <h1>{$project['type']}</h1>
                <p>{$project['location']}</p>
              </div>
              <div><img src='images/temp/projects/{$project['icon']}'></div>
            </div>
            <div class='tooltip'>
              <img src='images/temp/projects/{$project['subImage1']}'>
              <img src='images/temp/projects/{$project['subImage2']}'>
              </div>
            </div>
        
        ";
      }
      ?>

      <form action="includes/content/edit-content.inc.php?page=projects" method="post">
      <input type="hidden" name="hero-TITLE1" value="<?php echo $hero_TITLE1; ?>">
      <input type="hidden" name="hero-CAPTION1" value="<?php echo $hero_CAPTION1; ?>">
      <input type="hidden" name="hero-BUTTON" value="<?php echo $hero_BUTTON; ?>">
      <input type="hidden" name="prj-TITLE1" value="<?php echo $prj_TITLE1; ?>">

      
      <div class="button">
        <button type="submit" name="submit" class="submit">SAVE</button>
      </div>
    </form>
    <div class="button-cancel">
      <a href="content-management-projects.php"><button class="cancel" name="cancel">CANCEL</button></a>
    </div>
  </section>

  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>