<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Read the user data from the file
$file = '../data/users.json';
$data = json_decode(file_get_contents($file), true);

// Get the user's current username
$current_username = $_SESSION['username'];

// Get the new username from the form data
$new_username = $_POST['username'];

// Update the username in the user data
foreach ($data as &$user) {
  if ($user['username'] == $current_username) {
    $user['username'] = $new_username;
    break;
  }
}

// Save the updated user data to the file
file_put_contents($file, json_encode($data));

// Update the session variable with the new username
$_SESSION['username'] = $new_username;

// Redirect the user to the profile page
header("Location: profile.php");
exit();
?>
