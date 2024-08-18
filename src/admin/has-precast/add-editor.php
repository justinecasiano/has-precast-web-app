<?php
    session_start();

    $_SESSION["current"] = "editors";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>H&As' Precast</title>

  <!-- Site icon here -->

  <!-- Fonts used are downloaded here -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <!-- CSS stylesheets -->
  <link rel="stylesheet" href="styles/admin-global.css">
  <link rel="stylesheet" href="styles/editor.css">
  <link rel="stylesheet" href="styles/add-editor.css">
  <!-- Insert webpage specific stylesheets here -->

</head>

<body>
  <?php
    include("includes/admin-editor-header-sidebar.php");
  ?>

  <main>
    <div class="main-header">
      <h1>Account - Editors - Add Editor</h1>
    </div>

    <div class="form-wrapper">
      <form action="includes/account/add-editor.inc.php" method="POST">        
      
        <h1>New Editor</h1>
        <p>Enter new editor's information to proceed further</p>

        <div class="input-wrapper">
          <div>
            <label for="name">Name</label>
            <input type="text" name="name">
          </div>
          
          <div>
            <label for="email">Email</label>
            <input type="email" name="email">
          </div>

          <div>
            <label for="password">Password</label>
            <input type="password" name="password">
          </div>

          <div>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password">
          </div>

          <div class="buttons" id="buttons">
            <div></div>
            <div>
              <button type="submit" name="submit" class="submit">SUBMIT</button>
              <a href="account-management-editor.php"><button class="cancel">CANCEL</button></a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
</body>

</html>