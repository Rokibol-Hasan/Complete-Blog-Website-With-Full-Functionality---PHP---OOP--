<?php include "config/config.php"; ?>
<?php include "lib/Database.php"; ?>
<?php include "helpers/format.php"; ?>
<?php
$db = new Database();
$fm = new format();
?>
<!DOCTYPE html>
<html>

<head>

	<?php
	if (isset($_GET['pageid'])) {
		$pageid = $_GET['pageid'];
		$query = "SELECT * FROM tbl_page WHERE id = '$pageid'";
		$result = $db->select($query);
		if ($result) {
			while ($row = $result->fetch_assoc()) { ?>
				<title><?php echo $row['name'] . ' '; ?>|<?php echo ' ' . TITLE; ?></title>
			<?php }
		}
	} elseif (isset($_GET['id'])) {
		$postid = $_GET['id'];
		$query = "SELECT * FROM tbl_post WHERE id = '$postid'";
		$post = $db->select($query);
		if ($post) {
			while ($getPost = $post->fetch_assoc()) { ?>
				<title><?php echo $getPost['title'] . ' '; ?>|<?php echo ' ' . TITLE; ?></title>
		<?php }
		}
	} else { ?>
		<title><?php echo $fm->title() . ' '; ?>|<?php echo ' ' . TITLE; ?></title>
	<?php } ?>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">

	<?php

	if (isset($_GET['id'])) {
		$postid = $_GET['id'];
		$query = "SELECT * FROM tbl_post WHERE id = '$postid'";
		$result = $db->select($query);
		if ($result) {
			while ($getPost = $result->fetch_assoc()) { ?>
				<meta name="keywords" content="<?php echo $getPost['tags'] ?>">
	<?php }
		}
	}else {?>
		<meta name="keywords" content="<?php echo KEYWORDS; ?>">
	<?php } ?>
	<meta name="author" content="Rakib">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>
</head>

<body>
	<div class="headersection clear container-fluid">
		<div class="header-inner container">
			<div class="col-md-12">
				<a href="index.php">
					<?php
					$query = "SELECT * FROM title_slogan WHERE id = 1";
					$result = $db->select($query);
					if ($result) {
						while ($row = $result->fetch_assoc()) { ?>
							<div class="logo">
								<img src="admin/<?php echo $row['image'] ?>" alt="Logo" />
								<h2><?php echo $row['title'] ?></h2>
							</div>
					<?php }
					} ?>
				</a>
				<div class="social clear">
					<?php
					$query = "SELECT * FROM social_media WHERE id = 1";
					$result = $db->select($query);
					if ($result) {
						while ($row = $result->fetch_assoc()) { ?>
							<div class="icon clear">
								<a href="<?php echo $row['facebook']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
								<a href="<?php echo $row['twitter']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
								<a href="<?php echo $row['linkedin']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
								<a href="<?php echo $row['gplus']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
						<?php }
					} ?>
							</div>
							<div class="searchbtn clear">
								<form action="search.php" method="get">
									<input style="padding:20px 10px;" type="text" name="search" placeholder="Search keyword..." />
									<input type="submit" name="submit" value="Search" />
								</form>
							</div>
				</div>
			</div>
		</div>
	</div>
	<div class="navsection mb-3">
		<nav class="navbar navbar-expand-lg">
			<div class="container">
				<div class="collapse navbar-collapse " id="navbarNav">
					<?php

					$path = $_SERVER['SCRIPT_FILENAME'];
					$currentpage = basename($path, '.php');
					?>
					<ul class="navbar-nav">
						<li class="nav-item">
							<a <?php if ($currentpage == 'index') {
									echo 'id="active"';
								} ?> id="" class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
						</li>
						<?php
						$query = "SELECT * FROM tbl_page";
						$result = $db->select($query);
						if ($result) {
							while ($row = $result->fetch_assoc()) { ?>
								<li class="nav-item">
									<a <?php
										if (isset($_GET['pageid']) && $_GET['pageid'] == $row['id']) {
											echo 'id="active"';
										} ?>class="nav-link" href="singlepage.php?pageid=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
								</li>
						<?php  }
						} ?>
						<li class="nav-item">
							<a <?php if ($currentpage == 'contact') {
									echo 'id="active"';
								} ?> class="nav-link" href="contact.php">Contact</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>