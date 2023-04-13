<?php
session_start();

$users_data = json_decode(file_get_contents('../data/users.json'), true);

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if (isset($_POST['delete'])) {
    $delete_username = $_POST['delete'];
    if ($username === 'admin' && $delete_username !== 'admin') {
        unset($users_data[$delete_username]);
        file_put_contents('../data/users.json', json_encode($users_data));
    }
}

if (isset($_POST['moderate'])) {
    $moderate_username = $_POST['moderate'];
    if ($username === 'admin' && $moderate_username !== 'admin') {
        $users_data[$moderate_username]['moderated'] = true;
        file_put_contents('../data/users.json', json_encode($users_data));
    }
}

$user_data = $users_data[$username];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile | Cyberpunk</title>
	<link rel="stylesheet" type="text/css" href="../css/cyberpunk.css">
</head>
<body>
	<header>
		<h1>Cyberpunk</h1>
		<nav>
			<ul>
				<li><a href="main.php">Home</a></li>
				<li><a href="logout.php">Logout</a></li>
				<li><a href="submit_flag.php">Submit Flag</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<h1>Welcome, <?php echo $_SESSION["username"]; ?>!</h1>
		<?php
		
		if(($_SESSION['username']) === 'admin'){
			echo "<p>FLAG{admin}</p>";
		}

		?>
	
	    <p>Your current email is: <?php echo $_SESSION['email']; ?></p>
	    <div class="form-container">
  	<form action="update_username.php" method="POST">
    	<h2>Change Username</h2>
    	<label for="username">New Username:</label>
    	<input type="text" id="username" name="username" required>
    	<button type="submit">Change</button>
		<!--<p><a href="./53cr3t.php">Secret for admin</a></p> -->
  	</form>
	</div>
	<?php
			if ($username === 'admin') {
				echo "<h3>Moderate Users</h3>";
				echo "<ul>";
				foreach ($users_data as $user) {
					if ($user['username'] !== 'admin') {
						$username = $user['username'];
						$email = $user['email'];
						$moderated = $user['moderated'];
						echo "<li>";
						echo "<p>Username: $username</p>";
						echo "<p>Email: $email</p>";
						if ($moderated === false) {
							echo "<form method='post'>";
							echo "<input type='hidden' name='moderate' value='$username'>";
							echo "<input type='submit' value='Moderate'>";
							echo "</form>";
						}
						echo "<form method='post'>";
						echo "<input type='hidden' name='delete' value='$username'>";
						echo "<input type='submit' value='Delete'>";
						echo "</form>";
						echo "</li>";
					}
				}
				echo "</ul>";
			}
		?>

	</main>
</body>
</html>
