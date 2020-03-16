<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>

                <?php // Update Social media
                
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $fb = $fm->sanitaization($_POST['fb']);
                        $tw = $fm->sanitaization($_POST['tw']);
                        $ln = $fm->sanitaization($_POST['ln']);
                        $gp = $fm->sanitaization($_POST['gp']);
                        
                        $fb = mysqli_real_escape_string($db->link, $fb);
                        $tw = mysqli_real_escape_string($db->link, $tw);
                        $ln = mysqli_real_escape_string($db->link, $ln);
                        $gp = mysqli_real_escape_string($db->link, $gp);

                        if (empty($fb) || empty($tw) || empty($ln) || empty($gp)) {
                            echo "<span style='color: red; font-size: 18px;'>Feilds can not be empty.</span>";
                        } else {
                            $queryUpdate = "UPDATE tbl_social SET fb = '$fb', tw = '$tw', ln = '$ln', gp = '$gp' WHERE id = 1";

                            if ($db->update($queryUpdate)) {
                                echo 'Update Successfull';
                            } else {
                                echo 'Update Unsuccessfull';
                            }
                        }
                    }
                ?>

                <div class="block">

                <?php //Display Table
                
                    $queryShow  = "SELECT * FROM tbl_social";
                    $post       = $db->select($queryShow);

                    if($post) {
                        $result = $post->fetch_assoc();
                    }
                ?>

                 <form action="social.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?= $result['fb']; ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?= $result['tw']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?= $result['ln']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp" value="<?= $result['gp']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>

