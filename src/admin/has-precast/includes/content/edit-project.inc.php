<?php
  if(!isset($_POST['submit']) || isset($_POST['cancel'])){
    header("location: ../has-precast/content-management-projects.php");
  }


  include("../../classes/dbh.classes.php");
  include("../../classes/content-repo.classes.php");
  require("../image-handler.php");

  $cardID = $_GET['cardID'];
  $name = $_POST['name'];

  $desc = $_POST['desc'];
  $type = $_POST['type'];
  $loc = $_POST['loc'];
  $icon = $_POST['icon'];

  if(!empty($_FILES['mainImage']['name'])){
    $mainImage = $_FILES["mainImage"];
    
    $main = imageHandler2($mainImage, "projects");
  }
  else{
    $main['newName'] = $_POST['mainImg'];
  }
  
  if(!empty($_FILES['subImage1']['name'])){
    $subImage1 = $_FILES["subImage1"];
    
    $sub1 = imageHandler2($subImage1, "projects");
  }
  else{
    $sub1['newName'] = $_POST['subImg1'];
  }

  
  if(!empty($_FILES['subImage2']['name'])){
    $subImage2 = $_FILES["subImage2"];
    
    $sub2 = imageHandler2($subImage2, "projects");
  }
  else{
    $sub2['newName'] = $_POST['subImg2'];
  }



  $setContent = new ContentRepository;

  $setContent->setProjectUseID($desc, $type, $loc, $icon, $main["newName"], $sub1['newName'], $sub2['newName'], $cardID);
  
  $message = urlencode('Project Card &#34;'. $name .'&#34; has been Updated Successfully!');
  header("location: ../../../has-precast/content-management-projects.php?message={$message}&top=10&type=success");
  exit();
?>