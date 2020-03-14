<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
				<h2>Post List</h2>
				<?php
					// For delete post
					if (isset($_GET['deletePostId']) && $_GET['deletePostId'] != NULL) {
						$deletePostId = $_GET['deletePostId'];

						$queryImage = "SELECT image FROM tbl_post";
						$deleteImage = $db->select($queryImage);

						if ($deleteImage) {
							$result = mysqli_fetch_array($deleteImage);

							if(unlink($result['image'])) {
								$queryDelete = "DELETE FROM tbl_post WHERE id = '$deletePostId'";
								if ($db->delete($queryDelete)) {
									echo "Delete Successfull";
									// echo "<script>window.location = 'postlist.php'</script>";
								} else {
									echo "Delete Unsuccessfull";
									// echo "<script>window.location = 'postlist.php'</script>";
								}
							}

						}

					}
				?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No.</thwidth>
							<th width="15%">Title</th>
							<th width="20%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Image</th>
							<th width="10%">Tags</th>
							<th width="10%">author</th>
							<th width="10%">Date</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php	//Showing all posts in the table
							$query = "SELECT p.*, c.name FROM tbl_post p join tbl_category c on p.cat = c.id ORDER BY p.id desc";
							$post = $db->select($query);

							if($post) {
								$i = 0;
								while($result = $post->fetch_assoc()) {
									$i++;
							?>
									<tr class="odd gradeX">
										<td><?= $i; ?></td>
										<td><?= $result['title']; ?></td>
										<td><?= $fm->shortText($result['body'], 50); ?></td>
										<td><?= $result['name']; ?></td>
										<td><img src="<?= $result['image']; ?>" width="50px" height="50px"></td>
										<td><?= $result['tags']; ?></td>
										<td><?= $result['author']; ?></td>
										<td><?= $fm->dateFormat($result['date']); ?></td>
										<td>
											<a href="editpost.php?editPostId=<?=$result['id'];?>">Edit</a> 
											|| 
											<a onclick="return confirm('Are you Sure to delete?'); " href="?deletePostId=<?=$result['id'];?>">Delete</a>
										</td>
									</tr>
							<?php
								}
							}
						?>
						
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
	</script>

<?php include 'inc/footer.php'; ?>
