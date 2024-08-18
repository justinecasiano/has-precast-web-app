<?php
  session_start();

  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");

  $_SESSION["current"] = "userGuide";
  
  $getContent = new ContentRepository;

  $hero = $getContent->getHero();

  $userGuide = $getContent->getPage("USERGUIDE");
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
  <link rel="stylesheet" href="styles/table.css">

  <script defer src="scripts/global.js"></script>

</head>

<body>
  <?php
    include("includes/admin-editor-header-sidebar.php");
  ?>

  

  <main>
    <div class="main-header">
      <h1>Content Management - User Guide</h1>
    </div>

    <div class="table-wrapper">
      <div>
        <h3>User Guide</h3>
        <div class="edit-buttons">
          <form action="edit-content.php?page=userGuide" method="post">
            <button type="submit">Edit Page</button>
          </form>
          <a href="includes/content/default-content.inc.php?page=userGuide"><button>Reset to Default</button></a>
        </div>
      </div>
      <div class="table">
        <table>
          <thead>
            <tr>
              <th>Actions</th>
              <th>Section</th>
              <th>Name</th>
              <th>Type</th>
              <th>Content</th>
              <th class="create">Updated At</th>
            </tr>
          </thead>

          <?php 

          foreach($userGuide as $content){

            if($content['type'] === "IMAGE"){
              $object = "
                <img id='media' src='images/user-guide/{$content['object']}'>
              ";
            } 
            elseif($content['type'] === "VIDEO"){
              $object = "
                <video id='media-video' src='videos/user-guide/{$content['object']}' controls></video>
              ";
            }
            else{
              $object = $content['object'];
            }
            echo "
              <tbody>
                <tr>
                  <td>
                    <a href='includes/content/default-content.inc.php?page=userGuide&section={$content['section']}&name={$content['name']}'>Default</a>
                  </td>
                  <td>
                    $content[section]
                  </td>
                  <td>
                    $content[name]
                  </td>
                  <td>
                    $content[type]
                  </td>
                  <td>
                    $object
                  </td>
                  <td class='create'>
                    $content[created_at]
                  </td>
                </tr>
              </tbody>
            ";
          }
          ?>  
        </table>
      </div>
    </div>


  </main>
</body>

</html>