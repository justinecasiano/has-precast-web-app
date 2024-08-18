<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- includes fonts, stylesheets and site icon used -->
  <?php require 'partials/head.php' ?>

  <!-- link stylesheet for signup HTML -->
  <link rel="stylesheet" href="/website/assets/styles/base/login.css">
</head>

<body>
  <section class="index-login">
    <div class="wrapper">

      <div class="sign-up-link">
        <img src="/website/assets/images/login-and-signup/logo-white.png">
        <div>
          <h1>Hello, Friend!</h1>
          <p>Sign up and continue your journey with us!</p>
          <a href="/signup"><button>SIGN UP</button></a>
        </div>
      </div>

      <div class="login-form">
        <form action="http://backend.has-precast.com/login" method="POST">
          <h3>Login</h3>
          <p>Welcome back! Please login to your account</p>
          <label for="email">Email</label><br>
          <input type="email" name="email" placeholder="juandelacruz@gmail.com"><br>
          <label for="password">Password</label><br>
          <input type="password" name="password"><br>
          <a href="/forgot-password">Forgot password?</a><br>
          <div><button class="sign_in" type="submit">LOG IN</button></div>
        </form>
      </div>

    </div>
  </section>

  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>