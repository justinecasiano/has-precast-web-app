<details <?php $tabs = array('editors', 'clients'); if(in_array($_SESSION['current'], $tabs)){ echo 'open'; } ?> style="background-color: <?php  if(in_array($_SESSION['current'], $tabs)){ echo '#f0f0f0'; } ?>">
  <summary style="border-left: <?php if(in_array($_SESSION['current'], $tabs)){ echo '4px var(--clr-accent) solid'; } ?>;">
    <div class="accounts">
      <img src="images/NAV/accounts.svg">
      <p>Accounts</p>
    </div>
  </summary>

  <li onclick="window.location.href='../has-precast/account-management-editor.php';">
    <img src="images/NAV/<?php if($_SESSION['current'] === 'editors'){echo "bullet-current.svg";} else{echo "bullet.svg";}?>" alt="">
    <a href="../has-precast/account-management-editor.php">Editors</a>
  </li>

  <li onclick="window.location.href='../has-precast/account-management-client.php';">
    <img src="images/NAV/<?php if($_SESSION['current'] === 'clients'){echo "bullet-current.svg";} else{echo "bullet.svg";}?>" alt="">
    <a href="../has-precast/account-management-client.php">Clients</a>
  </li>
  
</details>