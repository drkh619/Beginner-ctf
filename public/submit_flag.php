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

$expire_time = 60; // 20 minutes in seconds
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
		<h1>CTF Platform</h1>
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
        <span style="color: green;"><b>Flag 1</b>:</span> <?php echo "Did you login? What does your profile look like? Hmm.. I would say check every corner"; ?><br>
    <?php } else { ?>
        <span><b>Flag 1</b>:</span> <?php echo "Did you login? What does your profile look like? Hmm.. I would say check every corner"; ?><br>
    <?php } ?>
</p>

<p>
    <?php if(($flag2_checked)) { ?>
        <span style="color: green; font-size: 20px">&#10003;</span>
        <span style="color: green;"><b>Flag 2</b>:</span> <?php echo "Are you sure you didn't miss anything? PS: Parameters are fun!"; ?><br>
    <?php } else { ?>
        <span><b>Flag 2</b>:</span> <?php echo "Are you sure you didn't miss anything? PS: Parameters are fun!"; ?><br>
    <?php } ?>
</p>

<p>
    <?php if(($flag3_checked)) { ?>
        <span style="color: green; font-size: 20px">&#10003;</span>
        <span style="color: green;"><b>Flag 3</b>:</span> <?php echo "admin account is great, but how can you access admin?"; ?><br>
    <?php } else { ?>
        <span><b>Flag 3</b>:</span> <?php echo "admin account is great, but how can you access admin?"; ?><br>
    <?php } ?>
</p>

        </div>
        <div class="post">
        	<h2><u>Rules</u></h2>
        	<ul class="rules">
    		<li><p>The format of Flag is as "^FLAG^flagName"</p></li>
    		<li><p>There is no need for bruteforcing technique of any kind</p></li>
    		<li><p>Please do not use your real email or password</p></li>
    		<li><p>If you find any vulnerabilities and they do not have any Flag, please report them to </p></li>
        </ul>
        
        </div>
    </div>
	</main>
</body>

</html>
