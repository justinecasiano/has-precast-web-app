<?php

if(isset($_POST['submit'])){
  include("../../classes/dbh.classes.php");
  include("../../classes/content-repo.classes.php");

  $setContents = new ContentRepository;

  include("../../classes/default-repo.php");

  $default = new DefaultRepository;

  $cards = array('card1', 'card2', 'card3', 'card4', 'card5', 'card6', 'card7');
  $name = $_POST['name'];

  if(in_array($name, $cards)){
    header("location: ../../../has-precast/content-management.php?error=alreadyexists");  
  }

  $desc = $_POST['desc'];
  $type = $_POST['type'];
  $loc = $_POST['loc'];
  $icon = $_POST['icon'];
  $mainImage = $_POST['mainImage'];
  $subImage1 = $_POST['subImage1'];
  $subImage2 = $_POST['subImage2'];
    
  $result = $setContents->addProject($name, $desc, $type, $loc, $icon, $mainImage, $subImage1, $subImage2);

  $message = urlencode('New Project Card &#34;'. $name . '&#34; has been Added to Projects Page');
  header("location: ../../../has-precast/content-management-projects.php?message={$message}&top=10&type=success");
  exit();
}
else{
  header("location: ../../../has-precast/content-management-projects.php?error=nones");
}


