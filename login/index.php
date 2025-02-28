<?php
session_start(); // Start the session to access session variables
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User - Login and Register</title>
  <link rel="stylesheet" href="style.css">
  <script src="/script.js"></script>
</head>
<body>
  
  <header>
    <h2>Carrier Express</h2>
    <nav>
      <a href="../index.html>HOME</a>
 
    </nav>

    <div class='sign-in-up'>
      <?php if (isset($_SESSION['username'])): ?>
        <span>Welcome, <?php echo $_SESSION['username']; ?>!</span>
        <!-- Logout button -->
        <form method="POST" action="login_register.php">
          <button type="submit" name="logout">Logout</button>
        </form>
      <?php else: ?>
        <!-- Login and Register buttons if the user is not logged in -->
        <button type="button" onclick="popup('login-popup')">LOGIN</button>
        <button type="button" onclick="popup('register-popup')">REGISTER</button>
      <?php endif; ?>

      <!-- Display errors or success messages -->
      <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
      <?php endif; ?>
      <?php if (isset($_SESSION['success'])): ?>
        <p style="color: green;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
      <?php endif; ?>
    </div>
  </header>

  <!-- Login Popup -->
  <div class="popup-container" id="login-popup">
    <div class="popup">
      <form method="POST" action="login_register.php">
        <h2>
          <span>USER LOGIN</span>
          <button type="reset" onclick="popup('login-popup')">X</button>
        </h2>
        <input type="text" placeholder="E-mail or Username" name="email_username">
        <input type="password" placeholder="Password" name="password">
        <button type="submit" class="login-btn" name="login">LOGIN</button>
      </form>
    </div>
  </div>

  <!-- Register Popup -->
  <div class="popup-container" id="register-popup">
    <div class="register popup">
      <form method="POST" action="login_register.php">
        <h2>
          <span>USER REGISTER</span>
          <button type="reset" onclick="popup('register-popup')">X</button>
        </h2>
        <input type="text" placeholder="Full Name" name="fullname">
        <input type="text" placeholder="Username" name="username">
        <input type="email" placeholder="E-mail" name="email">
        <input type="password" placeholder="Password" name="password">
        <button type="submit" class="register-btn" name="register">REGISTER</button>
      </form>
    </div>
  </div>

  <script>
    function popup(popup_name) {
      get_popup = document.getElementById(popup_name);
      if(get_popup.style.display == "flex") {
        get_popup.style.display = "none";
      } else {
        get_popup.style.display = "flex";
      }
    }
  </script>

</body>
</html>
