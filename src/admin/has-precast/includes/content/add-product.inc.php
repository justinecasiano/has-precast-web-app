<?php

if(isset($_POST['submit'])){
  include("../../classes/dbh.classes.php");
  include("../../classes/content-repo.classes.php");

  $setContents = new ContentRepository;

  include("../image-handler.php");


  $name = $_POST['name'];
  $desc = $_POST['desc'];
  $cart_image = $_POST['cart_image'];
  $wfb_image = $_POST['wfb_image'];

  

  $cart = productCopy($cart_image, "cart_$name");
  $wfb = productCopy($wfb_image, "wfb_$name");

  $result = $setContents->addProduct($name, $name, $desc, $cart, $wfb);

  $message = urlencode('New Prodocut &#34;'. $name . '&#34; has been Added');
  header("location: ../../../has-precast/content-management-products.php?message={$message}&top=10&type=success");
  exit();
}
else{
  header("location: ../../../has-precast/content-management-products.php");
}