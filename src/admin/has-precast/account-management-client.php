<?php
  session_start();
  include("includes/account/get-client.inc.php");

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
  <!-- Insert webpage specific stylesheets here -->

  
  <script defer src="scripts/global.js"></script>
</head>

<body>
  <?php
    include("includes/admin-editor-header-sidebar.php");
  ?>
  
  <main>
    <div class="main-header">
      <h1>Account Management - Clients</h1>
    </div>

  
    <div class="table">
        <table>
          <thead>
            <tr>
              <th>Actions</th>
              <th>Status</th>
              <th>ID</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Account Type</th>
              <th>Registered At</th>
            </tr>
          </thead>

          <?php
            foreach($result as $client){

              if($client['status'] === "ACTIVE"){
                $icon = "lock.svg";
                $tooltip = 'Suspend';
              }
              else{
                $icon = "unlock.svg";
                $tooltip = 'Unsuspend';
              }

              echo "
                <tbody>
                <tr>
                  <td>
                    <a class='table-tooltip' style='--content: \"Edit\";' href='edit-client.php?AccountID=$client[id]&name=$client[name]'><img src='images/admin-editor/Edit.svg'></a>
                    <a class='table-tooltip' style='--content: \"$tooltip\";' href='includes/account/status-client.inc.php?AccountID=$client[id]&status=$client[status]&name=$client[name]'><img src='images/admin-editor/$icon'></a>
                  </td>
                  <td>
                    $client[status]
                  </td>
                  <td>
                    $client[id]
                  </td>
                  <td>
                    $client[name]
                  </td>
                  <td>
                    $client[email]
                  </td>
                  <td>
                    $client[account_type]
                  </td>
                  <td>
                    $client[created_at]
                  </td>
                </tr>
              </tbody>
              ";
            }
          ?>
        </table>
    </div>
  </main>
</body>

</html>