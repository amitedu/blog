<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $copyright = $fm->sanitaization($_POST['copyright']);

                $copyright = mysqli_real_escape_string($db->link, $copyright);

                if (empty($copyright)) {
                    echo "<span style='color: red; fon-size: 18px;'>Feild must not be empty</span>";
                } else {
                    $queryupdate = "UPDATE tbl_footer SET note = '$copyright' WHERE id = 1";

                    if($db->update($queryupdate)) {
                        echo "Update Successful";
                    } else {
                        echo "Update Unsuccessful";
                    }
                }
            }
        ?>
        <div class="block copyblock"> 
            <form action="copyright.php" method="POST">
                <?php
                    $queryShow = "SELECT * FROM tbl_footer";
                    $note = $db->select($queryShow);

                    if ($note) {
                        $resultShow = $note->fetch_assoc();
                    }
                ?>
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" value="<?= $resultShow['note']; ?>" name="copyright" class="large" />
                    </td>
                </tr>
                
                    <tr> 
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