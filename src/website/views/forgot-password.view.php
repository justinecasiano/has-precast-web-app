<?php
if (!isset($_SESSION['code'])) {
  $_SESSION['sender'] = 'admin@has-precast.com';
  $_SESSION['link'] = 'http://has-precast.com/change-password';
  $_SESSION['code'] = substr(md5(mt_rand()), 0, 8);
}

if (isset($_GET['email'])) $_SESSION['email'] = $_GET['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>

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
        <form>
          <h3>Forgot Password</h3>
          <p>Please enter your email to recover your account</p>
          <label for="email">Email</label><br>
          <input type="email" name="email" placeholder="juandelacruz@gmail.com"><br>
          <div><button class="sign_in" type="submit">SEND EMAIL</button></div>
        </form>
      </div>
    </div>
  </section>

  <script>
    const form = document.querySelector('form');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      let email = form.querySelector('input[type="email"]');
      let button = form.querySelector('button');

      let data = {
        email: email.value,
        sender: <?= "\"{$_SESSION['sender']}\"" ?>,
        link: <?= "\"{$_SESSION['link']}\""  ?>,
        code: <?= "\"{$_SESSION['code']}\"" ?>
      };

      if (email.value) {
        button.disabled = true;

        let response = await fetch('https://script.google.com/macros/s/AKfycbx5M_sJ42B9T09ADxkRSLpLnpdrvUbWZi55ToOuli4jjT5TEEDq4Qcm3zSM4tUvp6AQ/exec', {
          method: 'POST',
          body: JSON.stringify(data)
        });

        let message = await response.json();
        console.log(message);
        if (message.status === 'success') {
          window.location = location + `?message=${encodeURI('Successfully sent link to change password in your email.')}&top=10&type=success&email=${email.value}`;
        }
        button.disabled = false;
      } else {
        window.location = location + `?message=${encodeURI('Empty input is not allowed. Please try again.')}&top=10&type=error`;
      }
    });
  </script>

  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>