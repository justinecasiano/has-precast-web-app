<?php
    $hero = $getContent->getSection($_GET['page'], "hero");
    $pre = $getContent->getSection($_GET['page'], "precontent");
    $table = $getContent->getSection($_GET['page'], "tablecontent");
    $ct1 = $getContent->getSection($_GET['page'], "content1");
    $ct2 = $getContent->getSection($_GET['page'], "content2");
    $img = $getContent->getImages($_GET['page']);
    $video = $getContent->getVideos($_GET['page']);
?>

<form action="../has-precast/preview.user-guide.php?page=<?php echo $_GET["page"]?>" method="post" enctype="multipart/form-data">    
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
  
  
  <h1>Pre-Content</h1>

  <?php
    foreach($pre as $content){
      echo "
        <div>
          <label for='pre-$content[name]'>$content[name]</label>
          <textarea name='pre-$content[name]' id='' cols='30' rows='10'>$content[object]</textarea>
        </div>
      ";
    }
  ?>

<h1>Table of Contents</h1>

<?php
  foreach($table as $content){
    echo "
      <div>
        <label for='table-$content[name]'>$content[name]</label>
        <textarea name='table-$content[name]' id='' cols='30' rows='10'>$content[object]</textarea>
      </div>
    ";
  }
?>

<h1>Content1</h1>

<?php
  foreach($ct1 as $content){
    echo "
      <div>
        <label for='ct1-$content[name]'>$content[name]</label>
        <textarea name='ct1-$content[name]' id='' cols='30' rows='10'>$content[object]</textarea>
      </div>
    ";
  }
?>

<div>
    <div>
        <label for='ct1-IMAGE1'>Step 1</label>
        <input type='file' name='ct1-IMAGE1'>
        <input type="hidden" name="ct1-img1" value="<?php echo $img[0]['object'];?>">
    </div>
    <img src="../has-precast/images/user-guide/<?php echo $img[0]['object'];?>">
</div>

<div>
    <div>
        <label for='ct1-IMAGE2'>Step 2</label>
        <input type='file' name='ct1-IMAGE2'>
        <input type="hidden" name="ct1-img2" value="<?php echo $img[1]['object'];?>">
    </div>
    <img src="../has-precast/images/user-guide/<?php echo $img[1]['object'];?>">
</div>

<div>
    <div>
        <label for='ct1-IMAGE3'>Step 3</label>
        <input type='file' name='ct1-IMAGE3'>
        <input type="hidden" name="ct1-img3" value="<?php echo $img[2]['object'];?>">
    </div>
    <img src="../has-precast/images/user-guide/<?php echo $img[2]['object'];?>">
</div>

<div>
    <div>
        <label for='ct1-IMAGE3'>Step 4</label>
        <input type='file' name='ct1-IMAGE4'>
        <input type="hidden" name="ct1-img4" value="<?php echo $img[3]['object'];?>">
    </div>
    <img src="../has-precast/images/user-guide/<?php echo $img[3]['object'];?>">
</div>

<div>
    <div>
        <label for='ct1-IMAGE5'>Step 5</label>
        <input type='file' name='ct1-IMAGE5'>
        <input type="hidden" name="ct1-img5" value="<?php echo $img[4]['object'];?>">
    </div>
    <img src="../has-precast/images/user-guide/<?php echo $img[4]['object'];?>">
</div>

<div>
    <div>
        <label for='ct1-IMAGE6'>Step 6</label>
        <input type='file' name='ct1-IMAGE6'>
        <input type="hidden" name="ct1-img6" value="<?php echo $img[5]['object'];?>">
    </div>
    <img src="../has-precast/images/user-guide/<?php echo $img[5]['object'];?>">
</div>

  

<h1>Content2</h1>

<?php
  foreach($ct2 as $content){
    echo "
      <div>
        <label for='ct2-$content[name]'>$content[name]</label>
        <textarea name='ct2-$content[name]' id='' cols='30' rows='10'>$content[object]</textarea>
      </div>
    ";
  }
?>

<div>
    <div>
        <label for='ct2-VIDEO1'>Video</label>
        <input type='file' name='ct2-VIDEO1'>
        <input type="hidden" name="ct2-vid1" value="<?php echo $video[0]['object'];?>">
    </div>
    <video src="../has-precast/videos/user-guide/<?php echo $video[0]['object'];?>" controls></video>
</div>

  <button type="submit" name="submit" class="submit">PREVIEW</button>
  <button class="cancel" name="cancel" type="submit">CANCEL</button>
</form>

