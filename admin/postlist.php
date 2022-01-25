<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<?php
				if (isset($_GET['del'])) {
					$id = $_GET['del'];
					$query = "DELETE FROM tbl_post WHERE id = $id";
					$delPost = $db->delete($query);
					if ($delPost) {
						echo "<h5 style = 'color:green'>Post Deleted!!</h5>";
					} else {
						echo "<h5 style = 'color:red'>Something went wrong!!</h5>";
					}
				}

				?>
				<thead>
					<tr>
						<th style="width: 5%;">No.</th>
						<th style="width: 15%;">Post Title</th>
						<th style="width: 20%;">Description</th>
						<th style="width: 5%;">Cat</th>
						<th style="width: 10%;">Image</th>
						<th style="width: 10%;">Tags</th>
						<th style="width: 15%;">Date</th>
						<th style="width: 10%;">Author</th>
						<th style="width: 10%;">Action</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$x = 1;
					$query = "SELECT tbl_post.*, tbl_cat.name FROM tbl_post INNER JOIN tbl_cat ON tbl_post.cat = tbl_cat.id ORDER BY tbl_post.title DESC";
					$result = $db->select($query);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) { ?>
							<tr class="odd gradeX">
								<td><?php echo $x;
									$x++ ?></td>
								<td><?php echo $fm->textshorten($row['title'], 30); ?></td>
								<td><?php echo $fm->textshorten($row['body'], 50); ?></td>
								<td><?php echo $row['name']; ?></td>
								<td><img class="mt-2" src="<?php echo $row['image']; ?>" alt="post image" width="70px" height="50px"></td>
								<td><?php echo $row['tags']; ?></td>
								<td><?php echo $fm->formatdate($row['date']); ?></td>
								<td><?php echo $row['author']; ?></td>
								<td>
									<a href="viewpost.php?pid=<?php echo $row['id']; ?>">View</a>
									<?php
									if (Session::get('id')==$row['userid'] || Session::get('role') == '0') { ?>
										||
										<a href="editpost.php?pid=<?php echo $row['id']; ?>">Edit</a>
										||
										<a onclick="return confirm('Are You Sure Want To Delete?')" href="postlist.php?del=<?php echo $row['id']; ?>">Delete<a>
											<?php } ?>
								</td>

							</tr>
					<?php }
					} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include "inc/footer.php"; ?>