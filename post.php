<?php include 'inc/header.php'; ?>

<?php
	if(!isset($_GET['id']) || $_GET['id'] == null) {
		header("Location: 404.php");
	} else {
		$id = $_GET['id'];
		$query = "SELECT * FROM tbl_post WHERE id = $id";
		$result = $db->select($query);
	}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
			<?php
				if($result) {
					$post = $result->fetch_assoc();	
			?>
				<h2><?= $post['title']; ?></h2>
				<h4><?= $fm->dateFormat($post['date']) ?>, By <?= $post['author']; ?></h4>
				<img src="admin/<?= $post['image']; ?>" alt="MyImage"/>
				<?= $post['body']; ?>
				
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
						$catid = $post['cat'];
						$queryReleted = "SELECT * FROM tbl_post WHERE cat = $catid limit 6";
						$resultReleted = $db->select($queryReleted);
						
						while($postsReleted = $resultReleted->fetch_assoc()) {
					?>
						<a href="post.php?id=<?= $postsReleted['id'] ?>"><img src="admin/<?= $postsReleted['image']; ?>" alt="post image"/></a>
					<?php
						}
					?>
				</div>
			<?php
				}
			?>
			</div>

		</div>
		
	<?php include 'inc/sidebar.php'; ?>
	</div>
<?php include 'inc/footer.php'; ?>