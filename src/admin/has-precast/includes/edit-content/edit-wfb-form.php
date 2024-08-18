<?php
    $hero = $getContent->getSection($_GET['page'], "hero");
    $table = $getContent->getSection($_GET['page'], "tablecontent");
    $wfb = $getContent->getSection($_GET['page'], "wfb");
    $designs = $getContent->getSection($_GET['page'], "designs");
    $dimensions = $getContent->getSection($_GET['page'], "dimensions");
    $strength = $getContent->getSection($_GET['page'], "strength");
    $img = $getContent->getImages($_GET['page']);
?>

<form action="../has-precast/preview.wall-form-blocks.php?page=<?php echo $_GET["page"]?>" method="post" enctype="multipart/form-data">    
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
        <label for='wfb-IMAGE1'>WFB IMAGE 1</label>
        <input type='file' name='wfb-IMAGE1'>
        <input type="hidden" name="wfb-img1" value="<?php echo $img[0]['object'];?>">
    </div>
    <img src="../has-precast/images/wall-form-blocks/<?php echo $img[0]['object'];?>">
</div>

<div>
    <div>
        <label for='wfb-IMAGE2'>WFB IMAGE 2</label>
        <input type='file' name='wfb-IMAGE2'>
        <input type="hidden" name="wfb-img2" value="<?php echo $img[1]['object'];?>">
    </div>
    <img src="../has-precast/images/wall-form-blocks/<?php echo $img[1]['object'];?>">
</div>


<h1>Designs</h1>

<?php
  foreach($designs as $content){
    echo "
      <div>
        <label for='dsgn-$content[name]'>$content[name]</label>
        <textarea name='dsgn-$content[name]' id='' cols='30' rows='10'>$content[object]</textarea>
      </div>
    ";
  }
?>


<h1>Dimensions and Sizes</h1>

<?php
  foreach($dimensions as $content){
    echo "
      <div>
        <label for='dmsn-$content[name]'>$content[name]</label>
        <textarea name='dmsn-$content[name]' id='' cols='30' rows='10'>$content[object]</textarea>
      </div>
    ";
  }
?>

<div>
    <div>
        <label for='dmsn-IMAGE1'>Image 1</label>
        <input type='file' name='dmsn-IMAGE1'>
        <input type="hidden" name="dmsn-img1" value="<?php echo $img[2]['object'];?>">
    </div>
    <img src="../has-precast/images/wall-form-blocks/<?php echo $img[2]['object'];?>">
</div>

<h1>Strength and Durability</h1>

<?php
  foreach($strength as $content){
    echo "
      <div>
        <label for='str-$content[name]'>$content[name]</label>
        <textarea name='str-$content[name]' id='' cols='30' rows='10'>$content[object]</textarea>
      </div>
    ";
  }
?>

<div>
    <div>
        <label for='str-IMAGE1'>Image 1</label>
        <input type='file' name='str-IMAGE1'>
        <input type="hidden" name="str-img1" value="<?php echo $img[3]['object'];?>">
    </div>
    <img src="../has-precast/images/wall-form-blocks/<?php echo $img[3]['object'];?>">
</div>



  <button type="submit" name="submit" class="submit">PREVIEW</button>
  <button class="cancel" name="cancel" type="submit">CANCEL</button>
</form>

