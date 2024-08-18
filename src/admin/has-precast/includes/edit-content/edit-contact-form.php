<?php
    $hero = $getContent->getSection($_GET['page'], "hero");
    $contacts = $getContent->getSection($_GET['page'], "contacts");
?>

<form action="../has-precast/preview.contact-us.php?page=<?php echo $_GET["page"]?>" method="post" enctype="multipart/form-data">    
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
  
  
  <h1>Contact Details</h1>

  <?php
    foreach($contacts as $content){
      echo "
        <div>
          <label for='contact-$content[name]'>$content[name]</label>
          <textarea name='contact-$content[name]' id='' cols='30' rows='10'>$content[object]</textarea>
        </div>
      ";
    }
  ?>



  <button type="submit" name="submit" class="submit">PREVIEW</button>
  <button class="cancel" name="cancel" type="submit">CANCEL</button>
</form>

