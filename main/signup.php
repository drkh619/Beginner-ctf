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
	<title>Signup | Cyberpunk</title>
	<link rel="stylesheet" type="text/css" href="css/cyberpunk.css">
</head>
<body>
	<header>
		<h1>Cyberpunk</h1>
		<nav>
			<ul>
				<li><a href="login.php">Login</a></li>
				<li><a href="signup.php" class="active">Signup</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<h1>Create an Account</h1>
		<form method="POST" action="">
			<label for="username">Username</label>
			<input type="text" id="username" name="username" placeholder="Enter your username" required>

			<label for="email">Email Address</label>
			<input type="email" id="email" name="email" placeholder="Enter your email address" required>

			<label for="password">Password</label>
			<input type="password" id="password" name="password" placeholder="Enter your password" required>

			<input type="submit" value="Signup">
		</form>
		<p>Already have an account? <a href="login.php">Login</a> now.</p>
	</main>
	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$username = $_POST["username"];
			$email = $_POST["email"];
			$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

			$users = [];
			if (file_exists("../data/users.json")) {
				$users = json_decode(file_get_contents("../data/users.json"), true);
			}

			if (array_key_exists($username, $users)) {
				echo "<script>alert('Username already exists.')</script>";
			} else {
				$users[$username] = [
					"email" => $email,
					"password" => $password
				];
				file_put_contents("../data/users.json", json_encode($users));

				$_SESSION["username"] = $username;
				header("Location: profile.php");
				exit();
			}
		}
	?>
</body>
</html>
