<!DOCTYPE html>
<html>

<head>
	<title>Submit Flag | CTF Platform</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/cyberpunk.css">
</head>

<body>
	<header>
		<h1>CTF Platform</h1>
		<nav>
			<ul>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="submit_flag.php">Submit Flag</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<h2>Submit Flag</h2>
		<form method="post" action="submit_flag_handler.php">
			<label for="flag">Flag</label>
			<input type="text" name="flag" id="flag" required>
			<button type="submit">Submit</button>
		</form>
        <?php
			if (isset($_POST['flag'])) {
				$flag = $_POST['flag'];
				// ... code to check if the flag is correct ...
				if ($flag == "correct_flag") {
					echo "<p class='success'>Flag submitted successfully!</p>";
				} else {
					echo "<p class='error'>Invalid flag!</p>";
				}
			}
		?>
	</main>
</body>

</html>
