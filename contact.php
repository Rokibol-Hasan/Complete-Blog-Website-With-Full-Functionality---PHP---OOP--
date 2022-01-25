<?php
include "inc/header.php";
?>
<?php
if (isset($_POST['submit'])) {
	$firstname = $fm->validation($_POST['firstname']);
	$lastname = $fm->validation($_POST['lastname']);
	$email = $fm->validation($_POST['email']);
	$body = $fm->validation($_POST['body']);

	$firstname = mysqli_real_escape_string($db->link, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($db->link, $_POST['lastname']);
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
	$body = mysqli_real_escape_string($db->link, $_POST['body']);
	$error = "";
	$msg = "";


	if (empty($firstname)) {
		$error = "First Name Must Not Be Empty";
	} elseif (empty($lastname)) {
		$error = "Last Name Must Not Be Empty";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = "Invalid Email Address";
	} elseif (empty($body)) {
		$error = "Message Body Must Not Be Empty";
	} else {
		$query = "INSERT INTO tbl_contact(firstname,lastname,email,body) VALUES('$firstname','$lastname','$email','$body')";
		$insertContact = $db->insert($query);

		if ($insertContact) {
			$msg = "Message Was Sent Successfully";
		} else {
			$error = "Message Wasn't Sent";
		}
	}
}

?>
<div class="contentsections container">
	<div class="row">
		<div class="col-md-8">
			<div class="maincontent">
				<div class="about">
					<h2>Contact us</h2>

					<?php
					if (isset($error)) {
						echo "<span style='color:red'>$error</span>";
					}
					if (isset($msg)) {
						echo "<span style='color:green'>$msg</span>";
					}
					?>

					<form action="contact.php" method="post">
						<table>
							<tr>
								<td>Your First Name:</td>
								<td>
									<input type="text" name="firstname" placeholder="Enter first name" />
								</td>
							</tr>
							<tr>
								<td>Your Last Name:</td>
								<td>
									<input type="text" name="lastname" placeholder="Enter Last name" />
								</td>
							</tr>

							<tr>
								<td>Your Email Address:</td>
								<td>
									<input type="email" name="email" placeholder="Enter Email Address" />
								</td>
							</tr>
							<tr>
								<td>Your Message:</td>
								<td>
									<textarea name="body"> </textarea>
								</td>
							</tr>
							<tr>
								<td>

								</td>
								<td>
									<input type="submit" name="submit" value="Send" />
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
		<?php
		include "inc/sidebar.php";

		?>

	</div>
</div>

<?php
include "inc/footer.php";

?>