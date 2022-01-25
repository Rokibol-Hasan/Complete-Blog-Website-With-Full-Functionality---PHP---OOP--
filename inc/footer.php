<section class="footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="footer-inner">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="#">Privacy</a></li>
					</ul>
					<?php
					$query = "SELECT * FROM copyright WHERE id = 1";
					$result = $db->select($query);
					if ($result) {
						while ($row = $result->fetch_assoc()) { ?>
							<p><?php echo $row['copyright'] . date(' Y') ?></p>
					<?php }
					} ?>
				</div>
			</div>

		</div>
	</div>
</section>
<script src="https://js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>

</html>