<?php
  session_start();

  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");

  $_SESSION["current"] = "hero";
  
  $getContent = new ContentRepository;

  $hero = $getContent->getHero();
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
      <h1>Content Management - Hero</h1>
    </div>

    <div class="table-wrapper">
      <div>
        <h3>Hero</h3>
        <div class="edit-buttons">
          <form action="edit-content.php?page=hero" method="post">
            <button type="submit">Add Hero Images</button>
          </form>
          <a href="includes/content/default-content.inc.php?type=hero"><button>Reset to Default</button></a>
        </div>
      </div>
      <div class="table">
        <table class="hero-table">
          <thead>
            <tr>
              <th>Actions</th>
              <th>Page</th>
              <th>Name</th>
              <th>Hero Media</th>
              <th class="create">Updated At</th>
            </tr>
          </thead>

          <?php 

          $defaults = array('homeHeroDefault', 'aboutHeroDefault', 'projectsHeroDefault', 'contactsHeroDefault', 'userHeroDefault', 'wfbHeroDefault');

          foreach($hero as $content){

            if(!in_array($content['name'], $defaults)){
              $actions = "
                <a class='table-tooltip' style='--content: \"Edit\";' href='edit-content.php?page=heroEdit&id={$content['id']}'><img src='images/admin-editor/Edit.svg'></a>
                <a class='table-tooltip' style='--content: \"Delete\";' href='includes/content/delete-hero.inc.php?id={$content['id']}&name={$content['name']}'><img src='images/admin-editor/Delete.svg'></a>
              ";
            }
            else{
              $actions = "<a>UNEDITABLE</a>";
            }

            if($content['name'] == "homeHeroDefault"){
              $media = "
                <video id='media' src='../has-precast/images/hero/{$content['page']}/{$content['object']}' controls></video>
              ";
            }
            else{
              $media = "
                <img id='media' src='images/hero/{$content['page']}/{$content['object']}'>
              ";
            }

            echo "
              <tbody>
                <tr>
                  <td>
                    $actions
                  </td>
                  <td>
                    $content[page]
                  </td>
                  <td>
                    $content[name]
                  </td>
                  <td>
                    $media
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