<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $title = $fm->sanitaization($_POST['title']);
                $slogan = $fm->sanitaization($_POST['slogan']);

                $title = mysqli_real_escape_string($db->link, $title);
                $slogan = mysqli_real_escape_string($db->link, $slogan);
                
                if ($_FILES['logo']['name']) {
                    
                    $permited = 'png';
                    $logoName = $_FILES['logo']['name'];
                    $logoSize = $_FILES['logo']['size'];
                    $logoTemp = $_FILES['logo']['tmp_name'];

                    $div      = explode('.', $logoName);
                    $logoExt  = end($div);
                    $uploadName = 'uploads/logo.png';
                    
                    if ($logoSize > 1000000) {
                        echo 'Fielsize must be under 1 MB';
                    } elseif ($logoExt != $permited) {
                        echo 'You can upload png file only';
                    } else {
                        if (move_uploaded_file($logoTemp, $uploadName)) {
                            $query = "UPDATE tbl_logo SET title = '$title', slogan = '$slogan', logo = '$uploadName' where id = 1";

                            if($db->update($query)) {
                                echo "Update Successfull";
                            } else {
                                echo "Update Unuccessfull";
                            }
                        } else {
                            echo 'File upload failed !';
                        }
                    }

                } else {
                    $query = "UPDATE tbl_logo SET title = '$title', slogan = '$slogan' where id = 1";

                    if($db->update($query)) {
                        echo "Update Successfull";
                    } else {
                        echo "Update Unuccessfull";
                    }
                }
                
            }
        ?>
        <?php
            $query = "SELECT * FROM tbl_logo";
            $row = $db->select($query);
            if($row) {
                $result = $row->fetch_assoc();
            }
        ?>
        <div class="leftside">
            <div class="block sloginblock">               
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" class="medium" value="<?= $result['title']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" name="slogan" class="medium" value="<?= $result['slogan']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input name="logo" type="file" class="medium">
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="rightside">
            <img class="updaleLogo" src="<?= $result['logo']; ?>" height="70px" width="100px">
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
