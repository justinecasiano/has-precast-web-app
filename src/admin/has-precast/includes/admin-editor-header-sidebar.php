<?php

  include("components/admin.header.php");

  if($_SESSION["userAccountType"] == "Admin"){
    include("components/admin-sidebar.php");
  }
  elseif($_SESSION["userAccountType"] == "Editor"){
    include("components/editor-sidebar.php");
  }
  

?>