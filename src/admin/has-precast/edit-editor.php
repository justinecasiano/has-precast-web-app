<?php
session_start();

include("classes/dbh.classes.php");

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
  <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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
      <h1>Account - Editors - Edit Editor</h1>
    </div>

    <div class="form-wrapper">
      <?php
      if (isset($_GET['ModeratorID'])) {
        $ModeratorID = $_GET["ModeratorID"];

        include("classes/admin-account-repo.php");

        $getEditor = new AccountRepository();

        $result = $getEditor->getEditorUseID($ModeratorID);
      }
      ?>
      <form action="includes/account/edit-editor.inc.php?ModeratorID=<?php echo $ModeratorID; ?>" method="POST">
        <input type="hidden" value="<?php echo $ModeratorID ?>">
        <h1>Edit Editor</h1>
        <p>Change editor's information to proceed further</p>

        <div class="input-wrapper">
          <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo $result["name"] ?>">
          </div>

          <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $result["email"] ?>">
          </div>

          <div class="buttons" id="buttons">
            <div></div>
            <div>
              <button type="submit" name="submit" class="submit">SAVE</button>
              <a href="account-management-editor.php"><button class="cancel">CANCEL</button></a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
</body>

</html>