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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">

  <!-- CSS stylesheets -->
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/admin-log-in.css">
  <script defer src="scripts/global.js"></script>
  <!-- Insert webpage specific stylesheets here -->

</head>

<body>
  <!-- Put your code here, make use of sections 
    as it spans the whole viewport (full screen) -->
  <section class="index-login">
    <div class="wrapper">

      <div class="login-left">
        <img src="images/log-in/logo-white.png">
        <div>
          <h1>Welcome Back!</h1>
          <p>Please enter your login details</p>
        </div>
      </div>

      <div class="login-form">
        <form action="http://backend.has-precast.com/login" method="POST">
          <h3>Login as Admin/Editor</h3>
          <p>Welcome back! Please login to your account</p>
          <label for="email">E-mail</label><br>
          <input type="email" name="email" placeholder="juandelacruz@gmail.com"><br>
          <label for="password">Password</label><br>
          <input type="password" name="password"><br>
          <a href="forgot-password.php">Forgot password?</a><br>
          <div><button class="sign_in" type="submit">LOG IN</button></div>
        </form>
      </div>
    </div>
  </section>

</body>

</html>