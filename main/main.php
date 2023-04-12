<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Main Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <?php if(isset($_SESSION['username'])) { ?>
      <a href="profile.php">Profile</a>
      <a href="submit_flag.php">Submit Flag</a>
      <a href="logout.php">Logout</a>
    <?php } else { ?>
      <a href="login.php">Login</a>
      <a href="signup.php">Sign Up</a>
      <a href="submit_flag.php">Submit Flag</a>
    <?php } ?>
  </div>
  <div class="content">
    <h1>Welcome to the Main Page</h1>
    <p>Here, you can access your profile and submit flags for the CTF.</p>
  </div>
</body>
</html>
