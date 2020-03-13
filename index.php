<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
		<?php
			$perPage = 3;
			if(isset($_GET['page'])) {
				$page = $_GET["page"];
			} else {
				$page = 1;
			}
			$startFrom = ($page - 1) * $perPage;
		?>

		<?php

			$query = "SELECT * FROM tbl_post ORDER BY id DESC LIMIT $startFrom, $perPage";
			$posts = $db->select($query);

			if($posts) {
				while($result = $posts->fetch_assoc()) {
		?>

			<div class="samepost clear">
				<h2><a href=""><?= $result['title']; ?></a></h2>
				<h4><?= $fm->dateFormat($result['date']); ?>, By <a href="#"><?= $result['author']; ?></a></h4>
				 <a href="#"><img src="admin/<?=$result['image'];?>" alt="post image"/></a>
				 <?= $fm->shortText($result['body']); ?>
				<div class="readmore clear">
					<a href="post.php?id=<?= $result['id']; ?>">Read More</a>
				</div>
			</div>

		<?php
				}
		?>
		<?php
			$query = "SELECT * FROM tbl_post";
			$result = $db->select($query);
			$totalRows = mysqli_num_rows($result);
			if($totalRows > $perPage) {
				$totalPage = ceil($totalRows/$perPage);
				echo "<span class='pagination'><a href='index.php?page=1'>First</a>";
				for ($i=2; $i <=$totalPage ; $i++) { 
					echo "<a href='index.php?page=$i'>$i</a>";
				}
				echo "<a href='index.php?page=$totalPage'>Last</a></span>";
			}
		?>
		<?php
			} else {
				header('Location: 404.php');
			}
		?>

		</div>
		<?php include 'inc/sidebar.php'; ?>
	</div>
<?php include 'inc/footer.php'; ?>