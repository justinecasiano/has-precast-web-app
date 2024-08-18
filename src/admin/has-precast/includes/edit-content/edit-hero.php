<?php
  

  $hero = $getContent->getHeroUseID($_GET['id']);

  $page = $hero['page'];

  
?>

<form action="../has-precast/includes/content/edit-content.inc.php?page=hero" method="POST" enctype="multipart/form-data">        
      
  <h1>Update <?php echo $hero['name']; ?> Hero Image</h1>
  
  <div class="input-wrapper">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input type="hidden" name="name" value="<?php echo $hero['name']; ?>">
    
    <div>
    <label for="page">Page</label>
    <select name="page" id="">
        <option value="home" <?php if($page === "HOME"){echo "selected";} ?>>Home</option>
        <option value="about" <?php if($page === "ABOUT"){echo "selected";} ?>>About Us</option>
        <option value="wfb" <?php if($page === "WFB"){echo "selected";} ?>>Wall Form Blocks</option>
        <option value="userGuide" <?php if($page === "USERGUIDE"){echo "selected";} ?>>User Guide</option>
        <option value="projects" <?php if($page === "PROJECTS"){echo "selected";} ?>>Projects</option>
        <option value="contact" <?php if($page === "CONTACT"){echo "selected";} ?>>Contact Us</option>
    </select>
    </div>


    <?php 
      if($page === "USERGUIDE"){
        $page = "userGuide";
      }
      else{
        $page = strtolower($page);
      }
    ?>

    <div>
      <div>
        <label for="object">Hero Media</label>
        <input type="file" name="object">
        <input type="hidden" name="objectOrig" value="../has-precast/images/hero/<?php echo $page; ?>/<?php echo $hero['object']; ?>">
      </div>
      <?php 
        $ext = explode('.', $hero['object']);
        $actualExt = strtolower(end($ext));

        $video = array('webm', 'mp4');
        if(in_array($actualExt, $video)){
          echo "<video id='hero_media' src='../has-precast/images/hero/{$page}/{$hero['object']}' controls></video>";
        }
        else{
          echo "<img id='hero_media' src='../has-precast/images/hero/{$page}/{$hero['object']}'>";
        }
      ?>
    </div>



    <div class="buttons" id="buttons">
    <div></div>
    <div>
        <button type="submit" name="submit" class="submit">SUBMIT</button>
        <a href="content-management-hero.php"><button class="cancel" name="cancel" type="submit">CANCEL</button></a>
    </div>
  </div>
</div>
</form>