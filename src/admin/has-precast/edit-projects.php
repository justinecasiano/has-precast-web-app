<?php
    session_start();

    $_SESSION["current"] = "editors";

    include("classes/dbh.classes.php");
    include("classes/content-repo.classes.php");

    if(!isset($_GET["cardID"])){
        header("location: content-management.php?");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>H&As' Precast</title>

  <!-- Site icon here -->

  <!-- Fonts used are downloaded here -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <!-- CSS stylesheets -->
  <link rel="stylesheet" href="styles/admin-global.css">
  <!-- Insert webpage specific stylesheets here -->
  <link rel="stylesheet" href="styles/content.css">
  
  <link rel="stylesheet" href="styles/add-editor.css">
</head>

<body>
  <?php
    include("includes/admin-editor-header-sidebar.php");
  ?>

  

  <main>
    <div class="main-header">
      <h1>Content Management - Edit </h1>
    </div>

      <?php
        if(isset($_GET['cardID'])){
        $cardID = $_GET["cardID"];

        $getProject = new ContentRepository();
            
        $result = $getProject->getProjectUseID($cardID);
        }
      ?>

      <div class="table">
      <form action="includes/content/edit-project.inc.php?cardID=<?php echo $_GET["cardID"]; ?>" method="POST" enctype="multipart/form-data">        
      
      <h1>Edit Project</h1>
      <p>Change project's information</p>
    
      <div class="input-wrapper">
        <input type="hidden" name="name" value="<?php echo $_GET['name']; ?>">
        <div>
        <label for="desc">Description</label>
        <input type="text" name="desc" value="<?php echo $result['description']; ?>">
        </div>
    
        <div>
        <label for="type">Type</label>
        <input type="text" name="type" value="<?php echo $result['type']; ?>">
        </div>
    
        <div>
        <label for="loc">Location</label>
        <input type="text" name="loc" value="<?php echo $result['location']; ?>">
        </div>
    
        <div>
        <label for="icon">Icon</label>
        <select name="icon">
          <?php

            if($result['icon'] === 'City.svg'){
              echo "
                <option value='city.svg'>Building</option>
                <option value='house.svg'>House</option>    
              ";
            }
            else{
              echo "
                <option value='house.svg'>House</option>
                <option value='city.svg'>Building</option>                  
              ";
            }

          ?>
        </select>
        </div>
    
        <div>
          <div>
            <label for="mainImage">Main Image</label>
            <input type="file" name="mainImage">
            <input type="hidden" name="mainImg" value="<?php echo $result['mainImage']; ?>">
          </div>
          <img src="images/temp/projects/<?php echo $result['mainImage']; ?>">
        </div>
    
        <div>
          <div>
            <label for="subImage1">Tooltip Image1</label>
            <input type="file" name="subImage1">
            <input type="hidden" name="subImg1" value="<?php echo $result['subImage1']; ?>">
          </div>
          <img src="images/temp/projects/<?php echo $result['subImage1']; ?>">
        </div>
    
        <div>
          <div>
            <label for="subImage2">Tooltip Image2</label>
            <input type="file" name="subImage2">
            <input type="hidden" name="subImg2" value="<?php echo $result['subImage2']; ?>">
          </div>
          <img src="images/temp/projects/<?php echo $result['subImage2']; ?>">
        </div>
    
        <div class="buttons" id="buttons">
        <div></div>
        <div>
            <button type="submit" name="submit" class="submit">SUBMIT</button>
            <a href="content-management-projects.php"><button class="cancel" type="button" name="cancel">CANCEL</button></a>
        </div>
      </div>
    </div>
    </form>

      
    </div>
  </main>
</body>

</html>