<?php
session_start();

$blog_data = json_decode(file_get_contents('../data/blog.json'), true);

if (!isset($_GET['id'])) {
    echo "No blog post selected";
    exit();
}

$id = $_GET['id'];
$blog_post = null;

foreach ($blog_data as $post) {
    if ($post['id'] == $id) {
        $blog_post = $post;
        break;
    }
}

if ($blog_post == null) {
    echo "Invalid blog post selected";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	<link rel="stylesheet" type="text/css" href="../css/cyberpunk.css">
</head>
<body>
	<header>
		<h1>Cyberpunk</h1>
		<nav>
			<ul>
				<?php
				if (isset($_SESSION['username'])) {
					echo "<li><a href='profile.php'>Profile</a></li>";
					echo "<li><a href='logout.php'>Submit Flag</a></li>";
				} else {
					echo "<li><a href='login.php'>Login</a></li>";
					echo "<li><a href='signup.php'>Sign Up</a></li>";
				}
				?>
                <li><a href="submit_flag.php">Submit Flag</a></li>
				<li><a href="main.php">Main Page</a></li>
			</ul>
		</nav>
	</header>
	<main>
    <div class="post">
        <h2><?php echo $blog_post['title']; ?></h2>
        <p><?php echo $blog_post['content']; ?></p>
        <p>Author: <?php echo $blog_post['author']; ?></p>
    </div>
	</main>
</body>
</html>
