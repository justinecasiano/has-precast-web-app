<?php
session_start();
include("includes/account/get-editor.inc.php");

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
  <!-- Insert webpage specific stylesheets here -->

  <script defer src="scripts/global.js"></script>
</head>

<body>
  <?php
  include("includes/admin-editor-header-sidebar.php");
  ?>

  <main>
    <div class="main-header">
      <h1>Account Management - Editors</h1>
      <a href="add-editor.php"><button>ADD EDITOR</button></a>
    </div>


    <div class="table">
      <table>
        <thead>
          <tr>
            <th>Actions</th>
            <th>Status</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Account Type</th>
            <th>Created At</th>
          </tr>
        </thead>

        <?php
        $buttons = '';
        foreach ($result as $editor) {
          if ($editor['type'] === 'Editor') {
            if ($editor['status'] === "ACTIVE") {
              $icon = "lock.svg";
              $tooltip = 'Suspend';
            } else {
              $icon = "unlock.svg";
              $tooltip = 'Unsuspend';
            }
            $buttons =
              "<a class='table-tooltip' style='--content: \"Edit\";' href='edit-editor.php?ModeratorID=$editor[id]'><img src='images/admin-editor/Edit.svg'></a>
              <a class='table-tooltip' style='--content: \"$tooltip\";'href='includes/account/status-editor.inc.php?ModeratorID=$editor[id]&status=$editor[status]&name=$editor[name]'><img src='images/admin-editor/$icon'></a>";
          } else {
            $buttons = "<a class='table-tooltip' style='--content: \"Edit\";' href='edit-editor.php?ModeratorID=$editor[id]'><img src='images/admin-editor/Edit.svg'></a>";
          }
          echo "
                <tbody>
                <tr>
                  <td>
                  $buttons
                  </td>
                  <td>
                    $editor[status]
                  </td>
                  <td>
                    $editor[id]
                  </td>
                  <td>
                    $editor[name]
                  </td>
                  <td>
                    $editor[email]
                  </td>
                  <td>
                    $editor[type]
                  </td>
                  <td>
                    $editor[created_at]
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