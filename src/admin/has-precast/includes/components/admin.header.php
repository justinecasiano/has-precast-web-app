<header>
    <div class="logo-container"><a href=<?php if($_SESSION["userAccountType"] == "Admin"){
                                                echo "../has-precast/admin-index.php";
                                              } 
                                              else{
                                                echo "../has-precast/content-management.php";
                                              }?>>
      <img src="images/logo-resized.png" alt="Logo"></a>
    </div>
    
    <div>
      <p>Welcome Back, <?php echo $_SESSION["userid"]?></p>
    </div>
    <div> 
      <?php
        if(isset($_SESSION["userAccountType"])){
      ?>
        <a href="#" class="username"><?php echo $_SESSION["userid"]?></a>
        <a href="includes/account/admin-log-out.inc.php" class="logout"><button>LOG OUT</button></a>
      <?php
        }
        else
        {
          header("location: ../../has-precast/admin-log-in.php");
        }
      ?>
    </div>
</header>