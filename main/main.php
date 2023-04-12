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
	<title>Cyberpunk</title>
	<link rel="stylesheet" type="text/css" href="css/cyberpunk.css">
</head>
<body>
	<header>
		<h1>Cyberpunk</h1>
	</header>
	<main>
		<h1>Welcome to Cyberpunk</h1>
		<p>Please <a href="login.php">login</a> or <a href="signup.php">signup</a> to continue.</p>
	</main>
</body>
</html>
