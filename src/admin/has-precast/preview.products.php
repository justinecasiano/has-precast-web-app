<?php
  if(!isset($_POST['submit'])){
    header("location: content-management-products.php");
  }

  if($_POST['submit'] === 'cancel'){
    header("location: content-management-products.php");
    exit();
  }

  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");

  require("includes/image-handler.php");

  $getContent = new ContentRepository;

  $content = $getContent->getSection('wfb' ,'designs');
  $products = $getContent->getProducts();

  if(
    empty($_POST['name']) ||
    empty($_POST['desc']) ||
    empty($_FILES['cart_image']['name']) ||
    empty($_FILES['wfb_image']['name'])
  ){
    $message = urlencode('Complete the Form Field to Add New Products!');
    header("location: content-management-products.php?message={$message}&top=10&type=error");
    exit();
  }

  $name = $_POST['name'];

  $getContent->checkProduct($name);

  $desc = $_POST['desc'];

  $cart = designHandler($_FILES['cart_image'], "cart-temp");
  $wfb = designHandler($_FILES['wfb_image'], "wfb-temp");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wall Form Blocks</title>

  <!-- includes fonts, stylesheets and site icon used -->
  <?php require 'partials/head.php' ?>

  <!-- link stylesheet for wall-form-blocks HTML -->
  <link rel="stylesheet" href="styles/base/wall-form-blocks2.css">
</head>

<body>
  <!-- includes HTML for navigation -->
  <?php require 'partials/navigation.php' ?>

  <!-- includes HTML for sidebar -->
  <?php require 'partials/sidebar.php' ?>

  <!-- main content starts here -->
  

  
  

  <section class="designs-wrapper">
    <h1><?php echo $content[0]['object']; ?></h1>

    <div class="designs">
    
      <?php 
        foreach($products as $content){
          echo "
          <div class='card-design'>
            <img src='images/products/$content[wfb_image]' alt=''>
            <div>
              <h1>$content[design_name]</h1>
              <p>$content[description]</p>
            </div>
          </div>
          ";}
      ?>

      <div class='card-design'>
        <img src='images/products/<?php echo $wfb['newName'];?>' alt=''>
        <div>
          <h1><?php echo $name;?></h1>
          <p><?php echo $desc;?></p>
        </div>
      </div>

    </div>
    
    <form action="includes/content/add-product.inc.php?page=products" method="post">
      <input type="hidden" name="name" value="<?php echo $name; ?>">
      <input type="hidden" name="desc" value="<?php echo $desc; ?>">
      <input type="hidden" name="cart_image" value="<?php echo $cart['destination']; ?>">
      <input type="hidden" name="wfb_image" value="<?php echo $wfb['destination']; ?>">

      
      <div class="button">
        <button type="submit" name="submit" class="submit">SAVE</button>
      </div>
    </form>
    <div class="button-cancel">
      <a href="content-management-products.php"><button class="cancel" name="cancel">CANCEL</button></a>
    </div>     
  </section>

  

  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>