<?php
    session_start();

    include("classes/dbh.classes.php");

    $_SESSION["current"] = "clients";
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
      <h1>Account - Clients - Edit Client</h1>
    </div>

    <div class="form-wrapper">
      <?php
        if(isset($_GET['AccountID'])){
        $AccountID = $_GET["AccountID"];

        include("classes/admin-account-repo.php");

        $getClient = new AccountRepository();
            
        $result = $getClient->getClientUseID($AccountID);
        }
      ?>
      <form action="includes/account/edit-client.inc.php?AccountID=<?php echo $AccountID;?>" method="POST">        
        <input type="hidden" value="<?php echo $AcccountID?>">
        <h1>Edit Client</h1>
        <p>Change client's information to proceed further</p>

        <div class="input-wrapper">
          <div>
            <label for="account_type">Account Type</label>
            <select class="accounttype" name="account_type">
              <option value="New">New</option>
              <option value="Bronze">Bronze</option>
              <option value="Silver">Silver</option>
              <option value="Gold">Gold</option>
            </select>
          </div>

          <div class="buttons" id="editclient">
            <div></div>
            <div>
              <button type="submit" name="submit" class="submit">SAVE</button>
              <a href="account-management-client.php"><button class="cancel">CANCEL</button></a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
</body>

</html>