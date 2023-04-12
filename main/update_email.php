<?php
	session_start();
	
	// Get the new email address from the form data
	$new_email = $_POST['new_email'];
	
	// Update the email address in the database
	// ... your code to update the database ...
	
	// Update the email address in the users.json file
	$file_path = "../data/users.json";
	$file_contents = file_get_contents($file_path);
	$users = json_decode($file_contents, true);

	foreach ($users as &$user) {
		if ($user['username'] == $_SESSION['username']) {
			$user['email'] = $new_email;
			break;
		}
	}

	// Save the updated users array to the users.json file
	$json_data = json_encode($users, JSON_PRETTY_PRINT);
	file_put_contents($file_path, $json_data);
	
	// Update the email address in the session variable
	$_SESSION['email'] = $new_email;
	
	// Redirect back to the profile page
	header("Location: profile.php");
	exit;
?>
