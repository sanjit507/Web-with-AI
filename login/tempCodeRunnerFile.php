<?php
<header>
    <h2>Carrier Express</h2>
    <nav>
      <a href="../index.html">HOME</a>
    </nav>

    <div class='sign-in-up'>
      <?php if (isset($_SESSION['username'])): ?>
        <span>Welcome, <?php echo $_SESSION['username']; ?>!</span>
        <!-- Logout button -->
        <form method="POST" action="index.php">
          <button type="submit" name="logout">Logout</button>
        </form>
      <?php else: ?>
        <!-- Login and Register buttons if the user is not logged in -->
        <button type="button" onclick="popup('login-popup')">LOGIN</button>
        <button type="button" onclick="popup('register-popup')">REGISTER</button>
      <?php endif; ?>
    </div>
  </header>