		<div class="footersection templete clear">
				<div class="footermenu clear">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="#">Privacy</a></li>
					</ul>
				</div>
				<?php // Display Footer table
					$queryShow = "SELECT * FROM tbl_footer";
					$note = $db->select($queryShow);

					if ($note) {
						$result = $note->fetch_assoc();
					}
				?>
				<p>&copy; <?= $result['note']; ?> 2019-<?= date('Y'); ?></p>
		</div>
		<div class="fixedicon clear">
			<?php
				$queryShow = "SELECT * FROM tbl_social";
				$post = $db->select($queryShow);

				if ($post) {
					$resultShow = $post->fetch_assoc();
				}
			?>
			<a href="<?= $resultShow['fb']; ?>"><img src="images/fb.png" alt="Facebook"/></a>
			<a href="<?= $resultShow['tw']; ?>"><img src="images/tw.png" alt="Twitter"/></a>
			<a href="<?= $resultShow['ln']; ?>"><img src="images/in.png" alt="LinkedIn"/></a>
			<a href="<?= $resultShow['gp']; ?>"><img src="images/gl.png" alt="GooglePlus"/></a>
		</div>
		<script type="text/javascript" src="js/scrolltop.js"></script>
	</body>
</html>