<?php


?>

<form action="../has-precast/preview.projects.php" method="POST" enctype="multipart/form-data">        
      
  <h1>New Project</h1>
  <p>Enter the new project's information</p>

  <div class="input-wrapper">
    <div>
    <label for="name">Name</label>
    <input type="text" name="name">
    </div>
    
    <div>
    <label for="desc">Description</label>
    <input type="text" name="desc">
    </div>

    <div>
    <label for="type">Type</label>
    <input type="text" name="type">
    </div>

    <div>
    <label for="loc">Location</label>
    <input type="text" name="loc">
    </div>

    <div>
    <label for="icon">Icon</label>
    <select name="icon">
      <option value="city.svg">Building</option>
      <option value="house.svg">House</option>
    </select>
    </div>

    <div>
      <label for="mainImage">Main Image</label>
      <input type="file" name="mainImage">
    </div>

    <div>
      <label for="subImage1">Tooltip Image1</label>
      <input type="file" name="subImage1">
    </div>

    <div>
      <label for="subImage2">Tooltip Image2</label>
      <input type="file" name="subImage2">
    </div>

    <div class="buttons" id="buttons">
    <div></div>
    <div>
        <button type="submit" name="submit" class="submit">PREVIEW</button>
        <a href="content-management-projects.php"><button type="submit" class="cancel" name="cancel">CANCEL</button></a>
    </div>
  </div>
</div>
</form>