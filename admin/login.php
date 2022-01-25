<?php
include "../lib/session.php";
Session::checkLogin();
?>
<?php include "../config/config.php"; ?>
<?php include "../lib/Database.php"; ?>
<?php include "../helpers/format.php"; ?>
<?php
$db = new Database();
$fm = new format();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
	<div class="container">
		<section id="content">
			<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$username = $fm->validation($_POST['username']);
				$password = $fm->validation(md5($_POST['password']));
				$username = mysqli_real_escape_string($db->link, $_POST['username']);
				$password = mysqli_real_escape_string($db->link, $_POST['password']);
				$query = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '" . md5($password) . "' ";
				$result = $db->select($query);
				if ($result != false) {
					$value = $result->fetch_assoc();
					//$value = mysqli_fetch_array($result);
					Session::set("login", true);
					Session::set("username", $value['username']);
					Session::set("id", $value['id']);
					Session::set("role", $value['role']);
					header("Location: index.php ");
				} else {
					echo "<script> alert('no result found') </script>";
				}
			}
			?>
			<form action="login.php" method="post">
				<h1>Admin Login</h1>
				<div>
					<input type="text" placeholder="Username" required="" name="username" />
				</div>
				<div>
					<input type="password" placeholder="Password" required="" name="password" />
				</div>
				<div>
					<input type="submit" value="Log in" />
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="forgotpass.php">Forgot Password?</a>
				<a href="#">Blog By Rokibol Hasan</a>
			</div><!-- button -->
		</section><!-- content -->
	</div><!-- container -->
</body>
<script src="https://js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>

</html>