<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Page</title>
  <link rel="stylesheet" type="text/css" href="../css/cyberpunk.css">
</head>
<body>
  <div class="header">
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
				<li><a href="main.php" class="active">Home</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="signup.php" class="active">Signup</a></li>
				<li><a href="submit_flag.php">Submit Flag</a></li>
			</ul>
		</nav>
    <?php } ?>
  </div>
  <div class="content">
    <h1>Welcome to the Main Page</h1>
    <p>Here, you can access your profile and submit flags for the CTF.</p>
  </div>
  <div class="post">
  <?php
    $blogData = file_get_contents('../data/blog.json');
    $blogData = json_decode($blogData, true);
    $post = $blogData[0]; // assuming the admin post is the first one in the array
    $post2 = $blogData[1];
  ?>
  <h2><?php echo $post['title']; ?></h2>
  <!-- <h2><a href="./blog.php?id=1">First post</a></h2> -->
  <div class="meta">
    <span class="author"><?php echo $post['author']; ?></span>
    <span class="date"><?php echo $post['date']; ?></span>
  </div>
  <p><?php echo $post['content']; ?></p>

  <h2><?php echo $post2['title']; ?></h2>
  <div class="meta">
    <span class="author"><?php echo $post2['author']; ?></span>
    <span class="date"><?php echo $post2['date']; ?></span>
  </div>
  <p><?php echo $post2['content']; ?></p>
</div>

</div>

</body>
</html>
