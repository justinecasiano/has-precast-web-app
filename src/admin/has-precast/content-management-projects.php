<?php
  session_start();

  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");

  $_SESSION["current"] = "projects";
  
  $getContent = new ContentRepository;

  $hero = $getContent->getHero();

  $userGuide = $getContent->getPage("USERGUIDE");

  $projectsContent = $getContent->getPage("projects");
  $projects = $getContent->getProjectsPage("projects");
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
      <h1>Content Management - Projects</h1>
    </div>

    

    <div class="table-wrapper">
      <div>
        <h3>Projects</h3>
        <div class="edit-buttons">
          <form action="edit-content.php?page=projectsContent" method="post">
            <button type="submit">Edit Page</button>
          </form>
          <a href="includes/content/default-content.inc.php?page=projectsContents"><button>Reset to Default</button></a>
        </div>
      </div>
      <div class="table">
        <table class="table-projects">
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

          foreach($projectsContent as $content){
            echo "
              <tbody>
                <tr>
                  <td>
                    <a href='includes/content/default-content.inc.php?page=projects&section={$content['section']}&name={$content['name']}'>Default</a>
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
                    $content[object]
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
    
    <div class="table-wrapper">
      <div>
        <h3>Projects - Card</h3>
          <div class="edit-buttons">
          <form action="edit-content.php?page=projects" method="post">
            <button type="submit">Add Projects</button>
          </form>
          <a href="includes/content/default-content.inc.php?page=projects"><button>Reset to Default</button></a>
        </div>
      </div>
      <div class="table">
        <table class="card-table">
          <thead>
            <tr>
              <th>Actions</th>
              <th>Card ID</th>
              <th>Name</th>
              <th>Description</th>
              <th>Type</th>
              <th>Location</th>
              <th>Icon</th>
              <th>Main Image</th>
              <th>Tooltip Image1</th>
              <th>Tooltip Image2</th>
              <th class="create">Updated At</th>
            </tr>
          </thead>

          <?php 

          foreach($projects as $content){

            

            echo "
              <tbody>
                <tr>
                  <td>
                    <a class='table-tooltip' style='--content: \"Edit\";' href='edit-projects.php?cardID={$content['cardID']}&name={$content['name']}'><img src='images/admin-editor/Edit.svg'></a>
                    <a class='table-tooltip' style='--content: \"Delete\";' href='includes/content/delete-project.inc.php?cardID={$content['cardID']}&name={$content['name']}'><img src='images/admin-editor/Delete.svg'></a>
                  </td>
                  <td>
                    $content[cardID]
                  </td>
                  <td>
                    $content[name]
                  </td>
                  <td>
                    $content[description]
                  </td>
                  <td>
                    $content[type]
                  </td>
                  <td>
                    $content[location]
                  </td>
                  <td>
                    <img id='icon' class='media' src='images/temp/projects/{$content['icon']}'>
                  </td>
                  <td>
                    <img class='media' src='images/temp/projects/{$content['mainImage']}'>
                  </td>
                  <td>
                    <img class='media' src='images/temp/projects/{$content['subImage1']}'>
                  </td>
                  <td>
                    <img class='media' src='images/temp/projects/{$content['subImage2']}'>
                  </td>
                  <td class='create'>
                    $content[UpdatedAt]
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