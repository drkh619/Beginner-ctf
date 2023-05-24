<?php
session_start();
//session_cache_expire(1)

$flag1 = "^FLAG^NTNjcjN0LnBocA";
$flag2 = "^FLAG^c2VjcmV0IHBhcmFtZXRlciB3b3c";
$flag3 = "^FLAG^YWRtaW4gZmVhdHVyZXM";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = $_POST["flag"];
    if ($flag == $flag1) {
        $_SESSION["flag1_checked"] = time();
    } elseif ($flag == $flag2) {
        $_SESSION["flag2_checked"] = time();
    } elseif ($flag == $flag3) {
        $_SESSION["flag3_checked"] = time();
    }
}

$flag1_checked = isset($_SESSION["flag1_checked"]) ? $_SESSION["flag1_checked"] : false;
$flag2_checked = isset($_SESSION["flag2_checked"]) ? $_SESSION["flag2_checked"] : false;
$flag3_checked = isset($_SESSION["flag3_checked"]) ? $_SESSION["flag3_checked"] : false;

$expire_time = 60 * 20; // 20 minutes in seconds
$now = time();

if (($flag1_checked || $flag2_checked || $flag3_checked) && (!isset($_SESSION["flag_checked_time"]))) {
    // set flag_checked_time to current time when any flag is checked for the first time
    $_SESSION["flag_checked_time"] = $now;
}

if (isset($_SESSION["flag_checked_time"]) && ($now - $_SESSION["flag_checked_time"] > $expire_time)) {
    // reset all flags if 20 minutes have passed since the first flag was checked
    $_SESSION["flag1_checked"] = false;
    $_SESSION["flag2_checked"] = false;
    $_SESSION["flag3_checked"] = false;
    unset($_SESSION["flag_checked_time"]); // unset flag_checked_time after resetting flags
} else {
    // reset individual flags if they have expired
    if ($flag1_checked && ($now - $_SESSION["flag_checked_time"] > $expire_time)) {
        $_SESSION["flag1_checked"] = false;
    }
    if ($flag2_checked && ($now - $_SESSION["flag_checked_time"] > $expire_time)) {
        $_SESSION["flag2_checked"] = false;
    }
    if ($flag3_checked && ($now - $_SESSION["flag_checked_time"] > $expire_time)) {
        $_SESSION["flag3_checked"] = false;
    }
}

//session_set_cookie_params(1200);

?>
<!DOCTYPE html>
<html>

<head>
	<title>Submit Flag | CTF Platform</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/flag.css">
</head>

<body>
	<header>
		<h1>CTF</h1>
		<?php if(isset($_SESSION['username'])) { ?>
      <nav>
			<ul>
				<li><a href="main.php">Home</a></li>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="submit_flag.php" class="active">Submit Flag</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
    <?php } else { ?>
      <nav>
			<ul>
				<li><a href="main.php" >Home</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="signup.php" >Signup</a></li>
				<li><a href="submit_flag.php" class="active">Submit Flag</a></li>
			</ul>
		</nav>
    <?php } ?>
	</header>
	
	<main>
	
	
	<h2>Submit Flag</h2>
		<div class="content">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<label for="flag">Flag:</label>
				<input type="text" name="flag" id="flag" required placeholder="^FLAG^YourFlag" pattern="^\^FLAG\^[A-Za-z0-9]+$">
				<button type="submit">Submit</button>
			</form>
			<div class="post">
			<h2><u>Hints</u></h2>
	<p>		
    <?php if(($flag1_checked)) { ?>
        <span style="color: green; font-size: 20px">&#10003;</span>
        <span style="color: green;"><b>Flag 1</b>:</span> <?php echo "Have you explored every corner of your profile page? I'd recommend taking a closer look, especially if you're interested in finding something that's not immediately visible. You might just stumble upon a hidden gem."; ?><br>
    <?php } else { ?>
        <span><b>Flag 1</b>:</span> <?php echo "Have you explored every corner of your profile page? I'd recommend taking a closer look, especially if you're interested in finding something that's not immediately visible. You might just stumble upon a hidden gem."; ?><br>
    <?php } ?>
</p>

<p>
    <?php if(($flag2_checked)) { ?>
        <span style="color: green; font-size: 20px">&#10003;</span>
        <span style="color: green;"><b>Flag 2</b>:</span> <?php echo "Remember, sometimes the most valuable information is hidden in plain sight. Don't forget to read between the lines and explore every aspect of the page. Oh, and keep an eye out for any parameters that might lead you down a path of discovery."; ?><br>
    <?php } else { ?>
        <span><b>Flag 2</b>:</span> <?php echo "Remember, sometimes the most valuable information is hidden in plain sight. Don't forget to read between the lines and explore every aspect of the page. Oh, and keep an eye out for any parameters that might lead you down a path of discovery."; ?><br>
    <?php } ?>
</p>

<p>
    <?php if(($flag3_checked)) { ?>
        <span style="color: green; font-size: 20px">&#10003;</span>
        <span style="color: green;"><b>Flag 3</b>:</span> <?php echo "Have you ever wondered what it's like to be admin? Maybe it's time to think outside the box and get creative. And don't forget to check out the home page for another helpful clue!"; ?><br>
    <?php } else { ?>
        <span><b>Flag 3</b>:</span> <?php echo "Have you ever wondered what it's like to be admin? Maybe it's time to think outside the box and get creative. And don't forget to check out the home page for another helpful clue!"; ?><br>
    <?php } ?>
</p>

        </div>
        
        <div class="imp">
  	<div class="important"><p><strong class="important-heading">Important information:</strong></p>
    		<p>Our challenges do NOT require any bruteforcing/directory fuzzing/massive amounts of traffic. Please practice hacking on our challenges manually.</p>
    		<p>Failure to abide by the rules will put you at risk of being disqualified!</p>
  	</div>
        </div>
        <div class="post">
        	<h2><u>Rules</u></h2>
        	<ul class="rules">
    		<li><p>The format of Flag is as "^FLAG^flagName"</p></li>
    		<li><p>Please do not use your real email or password</p></li>
    		<li><p>If you find any vulnerabilities and they do not have any Flag, please report them to </p></li>
        </ul>
        
        </div>
    </div>
	</main>
	<footer>
  <p>&copy; 2023 All rights reserved. Designed by <a href="https://github.com/drkh619/">drkh</a>.<img src="../css/github.png" alt="GitHub Logo"></p>
	</footer>
</body>

</html>
