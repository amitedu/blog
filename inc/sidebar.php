<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
						<?php
							$query = "SELECT * FROM tbl_category";
							$result = $db->select($query);
							if($result) {
								while($postsCategory = $result->fetch_assoc()) {
						?>
							<ul>
								<li>
									<a href="postsCategory.php?catId=<?= $postsCategory['id']; ?>"><?= $postsCategory['name']; ?></a>
								</li>
							</ul>
						<?php
								}
							}
						?>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
					<?php
						$query = "SELECT * FROM tbl_post ORDER BY date desc LIMIT 4 ";
						$posts = $db->select($query);
						if($posts) {
							while($result = $posts->fetch_assoc()) {
					?>
						<div class="popular clear">
							<h3><a href="post.php?id=<?= $result['id']; ?>"><?= $result['title']; ?></a></h3>
							<a href="post.php?id=<?= $result['id']; ?>"><img src="admin/uploads/<?=$result['image'];?>" alt="post image"/></a>
							<?= $fm->shortText($result['body'], 160); ?>	
						</div>
					<?php
							}
						}
					?>
	
			</div>
			
		</div>