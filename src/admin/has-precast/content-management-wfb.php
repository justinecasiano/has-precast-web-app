<?php
  session_start();

  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");

  $_SESSION["current"] = "wfb";
  
  $getContent = new ContentRepository;

  $hero = $getContent->getHero();

  $wfb = $getContent->getPage("WFB");

  
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
      <h1>Content Management -  Wall Form Blocks</h1>
    </div>

    

    <div class="table-wrapper">
      <div>
        <h3>Wall Form Blocks</h3>
        <div class="edit-buttons">
          <form action="edit-content.php?page=wfb" method="post">
            <button type="submit">Edit Page</button>
          </form>
          <a href="includes/content/default-content.inc.php?page=wfb"><button>Reset to Default</button></a>
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

          foreach($wfb as $content){

            if($content['type'] != "TEXT"){
              $object = "
                <img id='media' src='images/wall-form-blocks/{$content['object']}'>
              ";
            }
            else{
              $object = $content['object'];
            }
            echo "
              <tbody>
                <tr>
                  <td>
                    <a href='includes/content/default-content.inc.php?page=wfb&section={$content['section']}&name={$content['name']}'>Default</a>
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