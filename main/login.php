<?php
	session_start();
	if (isset($_SESSION["username"])) {
		header("Location: profile.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Cyberpunk</title>
	<link rel="stylesheet" type="text/css" href="css/cyberpunk.css">
</head>
<body>
	<header>
		<h1>Cyberpunk</h1>
		<nav>
			<ul>
				<li><a href="login.php" class="active">Login</a></li>
				<li><a href="signup.php">Signup</a></li>
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
	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$username = $_POST["username"];
			$password = $_POST["password"];

			$users = [];
			if (file_exists("../data/users.json")) {
				$users = json_decode(file_get_contents("../data/users.json"), true);
			}

			if (array_key_exists($username, $users) && password_verify($password, $users[$username]["password"])) {
				$_SESSION["username"] = $username;
				header("Location: profile.php");
				exit();
			} else {
				echo "<script>alert('Invalid username or password.')</script>";
			}
		}
	?>
</body>
</html>
