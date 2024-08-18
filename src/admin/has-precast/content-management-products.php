<?php
  session_start();

  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");

  $_SESSION["current"] = "products";
  
  $getContent = new ContentRepository;

  $products = $getContent->getProducts();
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
      <h1>Content Management - Products</h1>
    </div>

    <div class="table-wrapper">
      <div>
        <h3>Products</h3>
          <div class="edit-buttons">
          <form action="edit-content.php?page=products" method="post">
            <button type="submit">Add Product</button>
          </form>
          <a href="includes/content/default-content.inc.php?page=products"><button>Reset to Default</button></a>
        </div>
      </div>
      <div class="table">
        <table class="card-table">
          <thead>
            <tr>
              <th>Actions</th>
              <th>Status</th>
              <th>Design Name</th>
              <th class="desc">Description</th>
              <th>Cart Image</th>
              <th>WFB Image</th>
              <th class="create">Updated At</th>
            </tr>
          </thead>

          <?php 

          foreach($products as $content){

            if($content['status'] === 'AVAIL'){
              $class = "class='avail'";
              $status = "AVAILABLE";
            }
            else{
              $class = "class='notavail'";
              $status = "UNAVAILABLE";
            }

            echo "
              <tbody>
                <tr>
                  <td>
                    <a class='table-tooltip' style='--content: \"Edit\";' href='edit-content.php?page=productsEdit&id={$content['id']}&name={$content['name']}'><img src='images/admin-editor/Edit.svg'></a>
                    <a class='table-tooltip' style='--content: \"Delete\";' href='includes/content/delete-product.inc.php?id={$content['id']}&name={$content['name']}'><img src='images/admin-editor/Delete.svg'></a>
                  </td>
                  <td $class>
                    $status
                  </td>
                  <td>
                    $content[design_name]
                  </td>
                  <td id='desc'>
                    $content[description]
                  </td>
                  <td>
                    <img class='media' src='images/products/{$content['cart_image']}'>
                  </td>
                  <td>
                    <img class='media' src='images/products/{$content['wfb_image']}'>
                  </td>
                  <td class='create'>
                    $content[updated_at]
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