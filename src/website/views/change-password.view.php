<?php
if (!(isset($_SESSION['change-pass']) || $_GET['code'] === $_SESSION['code'])) {
  header('Location: http://has-precast.com/forgot-password');
  exit;
}

$_SESSION['change-pass'] = true;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>

  <!-- includes fonts, stylesheets and site icon used -->
  <?php require 'partials/head.php' ?>

  <!-- link stylesheet for signup HTML -->
  <link rel="stylesheet" href="/website/assets/styles/base/login.css">
  <link rel="stylesheet" href="/website/assets/styles/base/signup.css">
</head>

<body>
  <section class="index-login">
    <div class="wrapper">

      <div class="login-form">
        <form action="http://backend.has-precast.com/change-password" method="post">
          <h3>Change Password</h3>
          <p>Please enter your new password</p>
          <label for="password">Password</label><br>
          <input type="password" name="password"><br>
          <label for="password">Confirm Password</label><br>
          <input type="password" name="confirm_password"><br>
          <input type="hidden" name="email" value=<?= $_SESSION['email'] ?>><br>
          <div><button class="sign_in" type="submit">Change Password</button></div>
        </form>
      </div>

      <div class="log-in-link">
        <img src="/website/assets/images/login-and-signup/logo-white.png">
        <div>
          <h1>Welcome Back!</h1>
          <p>Let's Chat! To proceed,<br> please Login</p>
          <a href="/login"><button>LOG IN</button></a>
        </div>
      </div>
    </div>
  </section>

  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>