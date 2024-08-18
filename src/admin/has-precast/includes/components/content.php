<details <?php $tabs = array('products', 'hero', 'home', 'about', 'wfb', 'userGuide', 'projects', 'contact'); if(in_array($_SESSION['current'], $tabs)){ echo 'open'; }  ?> style="background-color: <?php if(in_array($_SESSION['current'], $tabs)){ echo '#f0f0f0'; } ?>">
  <summary style="border-left: <?php if(in_array($_SESSION['current'], $tabs)){ echo '4px var(--clr-accent) solid'; } ?>;">
    <div class="content">
      <img src="images/NAV/content.svg">
      <p>Content</p>
    </div>
  </summary>

  <li onclick="window.location.href='../has-precast/content-management-products.php';">
    <img src="images/NAV/<?php if($_SESSION['current'] === 'products'){echo "bullet-current.svg";} else{echo "bullet.svg";}?>" alt="">
    <a href="../has-precast/content-management-products.php">Products</a>
  </li>

  <li onclick="window.location.href='../has-precast/content-management-hero.php';">
      <img src="images/NAV/<?php if($_SESSION['current'] === 'hero'){echo "bullet-current.svg";} else{echo "bullet.svg";}?>" alt="">
      <a href="../has-precast/content-management-hero.php">Hero</a>
  </li>

  <li onclick="window.location.href='../has-precast/content-management-home.php';">
      <img src="images/NAV/<?php if($_SESSION['current'] === 'home'){echo "bullet-current.svg";} else{echo "bullet.svg";}?>" alt="">
      <a href="../has-precast/content-management-home.php">Home</a>
  </li>

  <li onclick="window.location.href='../has-precast/content-management-about.php';">
    <img src="images/NAV/<?php if($_SESSION['current'] === 'about'){echo "bullet-current.svg";} else{echo "bullet.svg";}?>" alt="">
    <a href="../has-precast/content-management-about.php">About Us</a>
  </li>

  <li onclick="window.location.href='../has-precast/content-management-wfb.php';">
      <img src="images/NAV/<?php if($_SESSION['current'] === 'wfb'){echo "bullet-current.svg";} else{echo "bullet.svg";}?>" alt="">
      <a href="../has-precast/content-management-wfb.php">WFB</a>
  </li>

  <li onclick="window.location.href='../has-precast/content-management-user-guide.php';">
    <img src="images/NAV/<?php if($_SESSION['current'] === 'userGuide'){echo "bullet-current.svg";} else{echo "bullet.svg";}?>" alt="">
    <a href="../has-precast/content-management-user-guide.php">User Guide</a>
  </li>

  <li onclick="window.location.href='../has-precast/content-management-projects.php';">
      <img src="images/NAV/<?php if($_SESSION['current'] === 'projects'){echo "bullet-current.svg";} else{echo "bullet.svg";}?>" alt="">
      <a href="../has-precast/content-management-projects.php">Projects</a>
  </li>

  <li onclick="window.location.href='../has-precast/content-management-contact.php';">
    <img src="images/NAV/<?php if($_SESSION['current'] === 'contact'){echo "bullet-current.svg";} else{echo "bullet.svg";}?>" alt="">
    <a href="../has-precast/content-management-contact.php">Contact Us</a>
  </li>
  
</details>
