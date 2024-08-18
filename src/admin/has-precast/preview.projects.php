<?php
  if(!isset($_POST['submit'])){
    header("location: content-management-projects.php");
  }
  elseif(isset($_POST['cancel'])){
    header("location: content-management-projects.php");
  }

  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");

  require("includes/image-handler.php");

  $getContent = new ContentRepository;

  $projectContents = $getContent->getPage("projects");
  

  $projects = $getContent->getProjectsPage("projects");

  $name = $_POST['name'];
  
  $check = $getContent->checkProjectCard($name);

  $desc = $_POST['desc'];
  $type = $_POST['type'];
  $loc = $_POST['loc'];
  $icon = $_POST['icon'];

  if(
    isset($_POST['cancel'])
  ){
      header("location: content-management-projects.php");
  }
  elseif(
    empty($_POST['name']) || 
    empty($_POST['desc']) ||
    empty($_POST['type']) || 
    empty($_POST['loc']) ||
    empty($_FILES['mainImage']['name']) || 
    empty($_FILES['subImage1']['name']) ||
    empty($_FILES['subImage2']['name'])
  ){
    $message = urlencode('Complete the Form Field to Upload New Project Card!');
    header("location: content-management-projects.php?message={$message}&top=10&type=error");
    exit();
  }
    $mainImage = $_FILES["mainImage"];
    $subImage1 = $_FILES["subImage1"];
    $subImage2 = $_FILES["subImage2"];
    
    $main = imageHandler($mainImage, "projects");
    $sub1 = imageHandler($subImage1, "projects");
    $sub2 = imageHandler($subImage2, "projects"); 
  
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
      <h1><?php echo $projectContents[0]['object'];  ?></h1>
      <p><?php echo $projectContents[1]['object'];  ?></p>
      <a href="projects#projects-wrapper"><button><?php echo $projectContents[2]['object'];  ?></button></a>
    </div>
  </section>

  <section id="projects-wrapper">
    <h1><?php echo $projectContents[3]['object'];  ?></h1>

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

      <div class="projects-card">
        <div><img src="<?php echo $main['destination']; ?>"></div>

        <div class="projects-description">
          <div>
            <p><?php echo $desc; ?></p>
            <h1><?php echo $type; ?></h1>
            <p><?php echo $loc; ?></p>
          </div>
          <div><img src="images/temp/projects/<?php echo $icon; ?>"></div>
        </div>
        <div class="tooltip">
          <img src="<?php echo $sub1['destination']; ?>">
          <img src="<?php echo $sub2['destination']; ?>">
        </div>
      </div>

      <form action="includes/content/add-project.inc.php?page=projects" method="post">
      <input type="hidden" name="name" value="<?php echo $name; ?>">
      <input type="hidden" name="desc" value="<?php echo $desc; ?>">
      <input type="hidden" name="type" value="<?php echo $type; ?>">
      <input type="hidden" name="loc" value="<?php echo $loc; ?>">
      <input type="hidden" name="icon" value="<?php echo $icon; ?>">
      <input type="hidden" name="mainImage" value="<?php echo $main['newName']; ?>">
      <input type="hidden" name="subImage1" value="<?php echo $sub1['newName']; ?>">
      <input type="hidden" name="subImage2" value="<?php echo $sub2['newName']; ?>">

      
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