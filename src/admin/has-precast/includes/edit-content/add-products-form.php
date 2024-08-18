<form action="../has-precast/preview.products.php" method="POST" enctype="multipart/form-data">        
      
  <h1>New Products</h1>
  <p>Enter the new Product Details</p>

  <div class="input-wrapper">
    <div>
    <label for="name">Design Name</label>
    <input type="text" name="name">
    </div>

    <div>
    <label for="desc">Description</label>
    <textarea name="desc"></textarea>
    </div>

    <div>
    <label for="cart_image">Cart Image</label>
    <input type="file" name="cart_image">
    </div>

    <div>
    <label for="wfb_image">WFB Image</label>
    <input type="file" name="wfb_image">
    </div>



    <div class="buttons" id="buttons">
    <div></div>
    <div>
        <button type="submit" value="submit" name="submit" class="submit">PREVIEW</button>
        <a href="content-management-products.php"><button class="cancel" value="cancel" name="submit" type="submit">CANCEL</button></a>
    </div>
  </div>
</div>
</form>