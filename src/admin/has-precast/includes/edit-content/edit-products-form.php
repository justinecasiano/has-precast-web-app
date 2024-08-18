<?php

    $product = $getContent->getProductUseId($_GET['id']);

?>

<form action="../has-precast/includes/content/edit-content.inc.php?page=products" method="POST" enctype="multipart/form-data">        
      
  <h1>Update <?php echo $product['name'];?></h1>
  <p>Enter the new Product Details</p>

  <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

  <div class="input-wrapper">
    <div>
    <label for="name">Design Name</label>
    <input type="text" name="name" value="<?php echo $product['design_name'];?>">
    </div>

    <div>
    <label for="desc">Description</label>
    <textarea name="desc"><?php echo $product['description'];?></textarea>
    </div>

    <div>
    <label for="status">Status</label>
    <select name="status" id="">
        <option value="AVAIL" <?php if($product['status'] === "AVAIL"){echo "selected";} ?>>Available</option>
        <option value="NOT AVAIL" <?php if($product['status'] === "NOT AVAIL"){echo "selected";} ?>>Not Available</option>>
    </select>
    </div>

    <div>
      <div>
        <label for="cart_image">Cart Image</label>
        <input type="file" name="cart_image">
        <input type="hidden" name="cartImg" value="<?php echo $product['cart_image']; ?>">
      </div>
        <img id='hero_media' src='../has-precast/images/products/<?php echo $product['cart_image']; ?>'>
    </div>

    <div>
      <div>
        <label for="wfb_image">WFB Image</label>
        <input type="file" name="wfb_image">
        <input type="hidden" name="wfbImg" value="<?php echo $product['wfb_image']; ?>">
      </div>
        <img id='hero_media' src='../has-precast/images/products/<?php echo $product['wfb_image']; ?>'>
    </div>

    



    <div class="buttons" id="buttons">
    <div></div>
    <div>
        <button type="submit" value="submit" name="submit" class="submit">SAVE</button>
        <a href="content-management-products.php"><button class="cancel" value="cancel" name="submit" type="submit">CANCEL</button></a>
    </div>
  </div>
</div>
</form>