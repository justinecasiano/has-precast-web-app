<?php
    $hero = $getContent->getSection($_GET['page'], "hero");
    $wfb = $getContent->getSection($_GET['page'], "wfb");
    $projects = $getContent->getSection($_GET['page'], "projects");
    $contact = $getContent->getSection($_GET['page'], "contact");
    $img = $getContent->getImages($_GET['page']);
?>

<form action="../has-precast/preview.index.php?page=<?php echo $_GET["page"]?>" method="post" enctype="multipart/form-data">    
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
  
  
  <h1>Wall Form Blocks</h1>

  <?php
    foreach($wfb as $content){
      echo "
        <div>
          <label for='wfb-$content[name]'>$content[name]</label>
          <textarea name='wfb-$content[name]' id='' cols='30' rows='10'>$content[object]</textarea>
        </div>
      ";
    }
  ?>

  <div>
    <div>
      <label for='wfb-IMAGE1'>Background</label>
      <input type='file' name='wfb-IMAGE1'>
      <input type="hidden" name="wfb-img1" value="<?php echo $img[0]['object'];?>">
    </div>
    <img src="../has-precast/images/index/<?php echo $img[0]['object'];?>">
  </div>

  <h1>Projects</h1>

  <?php
    foreach($projects as $content){
      echo "
        <div>
          <label for='prj-$content[name]'>$content[name]</label>
          <textarea name='prj-$content[name]' id='' cols='30' rows='10'>$content[object]</textarea>
        </div>
      ";
    }
  ?>

  <div>
    <div>
      <label for='prj-IMAGE1'>Project 1</label>
      <input type='file' name='prj-IMAGE1'>
      <input type="hidden" name="prj-img1" value="<?php echo $img[1]['object'];?>">
    </div>
    <img src="../has-precast/images/index/<?php echo $img[1]['object'];?>">
  </div>
  
  <div>
    <div>
      <label for='prj-IMAGE2'>Project 2</label>
      <input type='file' name='prj-IMAGE2'>
      <input type="hidden" name="prj-img2" value="<?php echo $img[2]['object'];?>">
    </div>
    <img src="../has-precast/images/index/<?php echo $img[2]['object'];?>">
  </div>

  <div>
    <div>
      <label for='prj-IMAGE3'>Project 3</label>
      <input type='file' name='prj-IMAGE3'>
      <input type="hidden" name="prj-img3" value="<?php echo $img[3]['object'];?>">
    </div>
    <img src="../has-precast/images/index/<?php echo $img[3]['object'];?>">
  </div>

  <div>
    <div>
      <label for='prj-IMAGE4'>Project 4</label>
      <input type='file' name='prj-IMAGE4'>
      <input type="hidden" name="prj-img4" value="<?php echo $img[4]['object'];?>">
    </div>
    <img src="../has-precast/images/index/<?php echo $img[4]['object'];?>">
  </div>

  <h1>Contact</h1>

  <?php
    foreach($contact as $content){
      echo "
        <div>
          <label for='contact-$content[name]'>$content[name]</label>
          <textarea name='contact-$content[name]' id='' cols='30' rows='10'>$content[object]</textarea>
        </div>
      ";
    }
  ?>

  <div>
    <div>
      <label for='contact-IMAGE1'>Background</label>
      <input type='file' name='contact-IMAGE1'>
      <input type="hidden" name="contact-img1" value="<?php echo $img[5]['object'];?>">
    </div>
    <img src="../has-precast/images/index/<?php echo $img[5]['object'];?>">
  </div>

  <button type="submit" name="submit" class="submit">PREVIEW</button>
  <button class="cancel" name="cancel" type="submit">CANCEL</button>
</form>

