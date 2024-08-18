<form action="../has-precast/preview.hero.php" method="POST" enctype="multipart/form-data">        
      
  <h1>New Hero Image</h1>
  <p>Enter the new Hero Image</p>

  <div class="input-wrapper">
    <div>
    <label for="name">Name</label>
    <input type="text" name="name">
    </div>
    
    <div>
    <label for="page">Page</label>
    <select name="page" id="">
        <option value="home">Home</option>
        <option value="about">About Us</option>
        <option value="wfb">Wall Form Blocks</option>
        <option value="userGuide">User Guide</option>
        <option value="projects">Projects</option>
        <option value="contact">Contact Us</option>
    </select>
    </div>

    <div>
    <label for="object">Hero Media</label>
    <input type="file" name="object">
    </div>



    <div class="buttons" id="buttons">
    <div></div>
    <div>
        <button type="submit" value="submit" name="submit" class="submit">PREVIEW</button>
        <a href="content-management-hero.php"><button class="cancel" value="cancel" name="submit" type="submit">CANCEL</button></a>
    </div>
  </div>
</div>
</form>