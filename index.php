<?php include "inc/header.php"; ?>
<div class="container">
	<div class="row">
		<div class="maincontent col-md-8">
			<!-- pagination -->
			<?php
			$per_page = 5; // Ami per page e koyta value dekhabo sei number
			if (isset($_GET["page"])) { // checking current page, wheather i am in main page or another page.
				$page = $_GET["page"]; // http://localhost/blog/index.php?page=2   1 2 3 4 5 6 7 8 9 10
			} else {
				$page = 1;
			}
			$start_from = ($page - 1) * $per_page;
			?>
			<!-- pagination -->
			<?php
			$query = "select * from tbl_post limit $start_from,$per_page";
			$post = $db->select($query);
			if ($post) {
				while ($result = $post->fetch_assoc()) {
			?>
					<div class="samepost">
						<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
						<h6><?php echo $fm->formatdate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h6>
						<a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image" /></a>

						<p oncopy="myFunction()"> <?php echo $fm->textshorten($result['body']); ?> </p>

						<div class="readmore">
							<a href="post.php?id=<?php echo $result['id']; ?>"> Read More </a>
						</div>
					</div>
				<?php }  ?>
				<!-- while loop end -->
				<!-- pagination -->
				<?php
				$query = "select * from tbl_post order by id desc";
				$result = $db->select($query);
				$total_rows = mysqli_num_rows($result);
				$total_page = ceil($total_rows / $per_page);
				echo "<span class='paginations'><a href='index.php?page=1'>" . 'First Page' . "</a>";
				for ($i = 1; $i <= $total_page; $i++) {
					echo "<a href='index.php?page=" . $i . "'>" . $i . "</a>";
				}
				echo "<a href='index.php?page=$total_page'>" . 'Last Page' . "</a></span>"; ?>
				<!-- pagination -->
			<?php } else {
				header("Location:php");
			} ?>
		</div>
		<?php include "inc/sidebar.php"; ?>
	</div>
</div>
<script type="text/javascript">
	function myFunction() {
		alert("You copied text!");
	}
</script>
<?php
include "inc/footer.php";
?>