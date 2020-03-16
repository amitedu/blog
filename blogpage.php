<?php include 'inc/header.php'; ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<?php
				if (isset($_GET['blogPageId']) && $_GET['blogPageId'] != NULL) {
					$id = $_GET['blogPageId'];

					$query = "SELECT * FROM tbl_page";
					$pages = $db->select($query);

					if($pages) {
						$result = $pages->fetch_assoc();
					}
				}
			?>
			<div class="about">
				<h2><?= $result['name']; ?></h2>
	
				<?= $result['body']; ?>
			</div>

		</div>

		<?php include 'inc/sidebar.php'; ?>
	</div>
<?php include 'inc/footer.php'; ?>
