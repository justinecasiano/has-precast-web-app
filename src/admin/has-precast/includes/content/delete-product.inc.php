<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $name = $_GET['name'];

    include("../../classes/dbh.classes.php");
    include("../../classes/content-repo.classes.php");

    $Delete = new ContentRepository;

    $Delete->deleteProductUseID($id, $name);

    $message = urlencode('Product '. $name .' Deleted Successfully');
    header("location: ../../content-management-products.php?message={$message}&top=10&type=success");
    exit();
}