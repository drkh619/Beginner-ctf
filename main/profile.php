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

		<p>Here is a <a href="53cr3t.php">Secret</a> for you!</p>
	
	    <p>Your current email is: <?php echo $_SESSION['email']; ?></p>
	    <form method="POST" action="update_email.php">
		    <label for="new_email">Enter your new email:</label>
		    <input type="email" id="new_email" name="new_email" required>
		    <input type="submit" value="Update">
	</main>
</body>
</html>
