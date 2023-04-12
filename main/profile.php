<?php
	session_start();
	if (!isset($_SESSION["username"])) {
		header("Location: login.php");
		exit();
	}

	$users = json_decode(file_get_contents("../data/users.json"), true);
	$user = $users[$_SESSION["username"]];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile | Cyberpunk</title>
	<link rel="stylesheet" type="text/css" href="css/cyberpunk.css">
</head>
<body>
	<header>
		<h1>Cyberpunk</h1>
		<nav>
			<ul>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<h1>Welcome, <?php echo $_SESSION["username"]; ?>!</h1>
		<p>Your email address is <?php echo $user["email"]; ?></p>
	</main>
</body>
</html>
