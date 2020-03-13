<?php include 'inc/header.php'; ?>


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
            if(isset($_GET['search'])) {
				$keyword = $_GET["search"];
			}
			$query = "SELECT * FROM tbl_post WHERE title LIKE '%$keyword%' OR body LIKE '%$keyword%' LIMIT $startFrom, $perPage";
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
			$queryPage = "SELECT * FROM tbl_post WHERE title LIKE '%$keyword%' OR body LIKE '%$keyword%'";
			$postsPage = $db->select($queryPage);
            $totalRows = mysqli_num_rows($postsPage);
            if($totalRows > $perPage) {
                $totalPage = ceil($totalRows/$perPage);
                echo "<span class='pagination'><a href='search.php?page=1&search=$keyword'>First</a>";
                for ($i=2; $i <=$totalPage ; $i++) { 
                    echo "<a href='search.php?page=$i&search=$keyword'>$i</a>";
                }
                echo "<a href='search.php?page=$totalPage&search=$keyword'>Last</a></span>";
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