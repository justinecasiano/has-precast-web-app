<?php
    $page = "PROJECTS";
    $hero = $getContent->getSection($page, "hero");
    $projects = $getContent->getSection($page, "projects");
?>

<form action="../has-precast/preview.project-contents.php?page=<?php echo $_GET["page"]?>" method="post" enctype="multipart/form-data">    
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



  <button type="submit" name="submit" class="submit">PREVIEW</button>
  <button class="cancel" name="cancel" type="submit">CANCEL</button>
</form>

