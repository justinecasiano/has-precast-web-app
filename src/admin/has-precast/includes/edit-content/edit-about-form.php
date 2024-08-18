<?php
  $hero = $getContent->getSection($_GET['page'], 'hero');
  $about = $getContent->getSection($_GET["page"], "about");
  $mv = $getContent->getSection($_GET["page"], "MISSIONVISION");
  $img = $getContent->getImages($_GET["page"]);
?>

<form action="../has-precast/preview.<?php echo $_GET["page"]?>.php?page=<?php echo $_GET["page"]?>" method="post" enctype="multipart/form-data">    
  
<h1>Hero</h1>

<?php
  foreach($hero as $content){
    echo "
      <div>
        <label for='hero-$content[name]'>$content[name]</label>
        <textarea name='hero-$content[name]' id=''>$content[object]</textarea>
      </div>
    ";
  }
?>

  <h1>About</h1>

  <?php
    foreach($about as $content){
      echo "
        <div>
          <label for='about-$content[name]'>$content[name]</label>
          <textarea name='about-$content[name]' id=''>$content[object]</textarea>
        </div>
      ";
    }
  ?>
  <div>
    <div>
      <label for='about-IMAGE1'>Image</label>
      <input type='file' name='about-IMAGE1'>
      <input type="hidden" name="about-img1" value="<?php echo $img[0]['object'];?>">
    </div>
    <img src="../has-precast/images/temp/about-us/<?php echo $img[0]['object'];?>">
  </div>
  
  <h1>Mission Vision</h1>

  <?php
    foreach($mv as $content){
      echo "
        <div>
          <label for='mv-$content[name]'>$content[name]</label>
          <textarea name='mv-$content[name]' id='' cols='30' rows='10'>$content[object]</textarea>
        </div>
      ";
    }
  ?>

  <div>
    <div>
      <label for="mv-IMAGE1">Background</label>
      <input type="file" name="mv-IMAGE1">
      <input type="hidden" name="mv-img1" value="<?php echo $img[1]['object'];?>">
    </div>
    <img src="../has-precast/images/temp/about-us/<?php echo $img[1]['object'];?>" alt="">
  </div>

  
  <button type="submit" name="submit" class="submit">PREVIEW</button>
  <a href="../has-precast/content-management.php"><button class="cancel">CANCEL</button></a>
</form>