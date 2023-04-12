<?php
session_start();

if(isset($_SESSION['username'])) {
  header("Location: profile.php");
}

if(isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Read the user data from the JSON file
  $users_json = file_get_contents('../data/users.json');
  $users = json_decode($users_json, true);

  foreach($users as $user) {
    if($user['username'] == $username && password_verify($password, $user['password'])) {
      $_SESSION['username'] = $username;
      header("Location: profile.php");
      exit();
    }
  }
  
  echo "<script>alert('Invalid username or password.')</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Cyberpunk</title>
	<link rel="stylesheet" type="text/css" href="../css/cyberpunk.css">
</head>
<body>
	<header>
		<h1>Cyberpunk</h1>
		<nav>
			<ul>
				<li><a href="login.php" class="active">Login</a></li>
				<li><a href="signup.php">Signup</a></li>
				<li><a href="submit_flag.php">Submit Flag</a></li> 
			</ul>
		</nav>
	</header>
	<main>
		<h1>Login to your Account</h1>
		<form method="POST" action="">
			<label for="username">Username</label>
			<input type="text" id="username" name="username" placeholder="Enter your username" required>

			<label for="password">Password</label>
			<input type="password" id="password" name="password" placeholder="Enter your password" required>

			<input type="submit" value="Login">
		</form>
		<p>Don't have an account? <a href="signup.php">Sign up</a> now.</p>
	</main>
	
</body>
</html>
