<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>

  <!-- includes fonts, stylesheets and site icon used -->
  <?php require 'partials/head.php' ?>

  <!-- link stylesheet for signup HTML -->
  <link rel="stylesheet" href="/website/assets/styles/base/signup.css">
</head>

<body>
  <section class="index-login">
    <div class="wrapper">

      <div class="registration-form">
        <form id="signup-form" action="http://backend.has-precast.com/signup" method="POST">
          <h3>Sign Up</h3>
          <p>Enter your information to proceed further</p>

          <label for="email">Email</label><br>
          <input type="email" name="email" placeholder="juandelacruz@gmail.com"><br>

          <div class="name">
            <div class="first-name">
              <label for="first_name">First Name</label>
              <input type="text" name="first_name" placeholder="Juan">
            </div>

            <div class="last-name">
              <label for="last_name">Last Name</label>
              <input type="text" name="last_name" placeholder="Dela Cruz">
            </div>
          </div>

          <label for="password">Password</label><br>
          <input type="password" name="password"><br>
          <label for="confirm_password">Confirm Password</label><br>
          <input type="password" name="confirm_password"><br>
          <div class="register-button"><button class="register" type="submit">REGISTER</button></div>
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