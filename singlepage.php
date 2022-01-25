<?php
include "inc/header.php";
?>
<?php
if (isset($_GET['id'])) {
	$pageid = $_GET['id'];
}
?>
<div class="container">
	<div class="row">
		<div class="contentsection col-md-8">
			<div class="about">
				<?php
				$query = "SELECT * FROM tbl_page WHERE id = '$pageid'";
				$result = $db->select($query);
				if ($result) {
					while ($row = $result->fetch_assoc()) { ?>
						<h2><?php echo $row['name'] ?></h2>
						<p><?php echo $row['body'] ?></p>
				<?php }
				}else {
					header("Location:404.php");
				} ?>
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