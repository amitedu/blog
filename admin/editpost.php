<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">

    <div class="box round first grid">
        <?php

            // Update Post
        
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $id = $_GET['editPostId'];
                
                $title  = mysqli_real_escape_string($db->link, $_POST['title']);
                $cat    = mysqli_real_escape_string($db->link, $_POST['cat']);
                $body   = mysqli_real_escape_string($db->link, $_POST['body']);
                $tags   = mysqli_real_escape_string($db->link, $_POST['tags']);
                $author = mysqli_real_escape_string($db->link, $_POST['author']);

                if ($_FILES['image']['name']) {
                    
                    $permitted    = ['png', 'jpg', 'jpeg', 'gif'];
                    $newImageName = $_FILES['image']['name'];
                    $newImageSize = $_FILES['image']['size'];
                    $newImageTemp = $_FILES['image']['tmp_name'];
    
                    $div          = explode('.', $newImageName);
                    
                    $newImageExt  = end($div);

                    if ($newImageSize > 1000000) {
                        echo "Image size must be under 1 MB";
                        die();
                    } elseif (! in_array($newImageExt, $permitted)) {
                        echo "Image can only be : " . implode(', ', $permitted);
                        die();
                    }

                    $imagePath = "uploads/" . uniqid() . "." . $newImageExt;

                    $uploadCondition = move_uploaded_file($newImageTemp, $imagePath);

                } else {
                    $imagePath = mysqli_real_escape_string($db->link, $_POST['oldImage']);
                    $uploadCondition = true;
                }

                
                if (empty($title) || empty($cat) || empty($body) || empty($tags) || empty($author)) {
                    echo "Feild must not be empty";
                } else {
                    if ($uploadCondition) {

                        $queryUpdate = "UPDATE tbl_post SET cat = '$cat', title = '$title', body = '$body', image = '$imagePath', author = '$author', tags = '$tags' WHERE id = '$id'";

                        if ($db->update($queryUpdate)) {
                            echo "Post Update Successfully";
                        } else {
                            echo "Post Update Unsuccessful";
                        }

                    } else {
                        echo "File can not be uploaded";
                    }
                    
                }

                
            }
        ?>
        <h2>Add New Post</h2>
        <div class="block">    
            <form action="" method="POST" enctype="multipart/form-data">
            <?php
                
                // Display post

                if (isset($_GET['editPostId']) && $_GET['editPostId'] != NULL) {
                    $id = $_GET['editPostId'];
                    
                    $queryDisplay = "SELECT * FROM tbl_post WHERE id = $id";
                    $post = $db->select($queryDisplay);

                    if ($post) {
                        while ($resultDisplay = $post->fetch_assoc()) {
            ?>
                            <table class="form">
                                <tr>
                                    <td>
                                        <label>Title</label>
                                    </td>
                                    <td>
                                        <input type="text" name="title" value="<?= $resultDisplay['title']; ?>" class="medium" />
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <label>Category</label>
                                    </td>
                                    <td>
                                        <select id="select" name="cat">
                                            <option>Select One</option>
                                                <?php
                                                    $queryCategory = "SELECT * FROM tbl_category";
                                                    $category = $db->select($queryCategory);

                                                    if ($category) {
                                                        while ($resultCategory = $category->fetch_array()) {
                                                ?>
                                                            <option value="<?= $resultCategory['id']; ?>" <?= ($resultCategory['id'] == $resultDisplay['cat']) ? "selected" : ""; ?> ><?= $resultCategory['name']; ?></option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Upload Image</label>
                                    </td>
                                    <td>
                                        <img src="<?= $resultDisplay['image']; ?>" height="80px;" width="200px">
                                        <input type="hidden" name="oldImage" value="<?= $resultDisplay['image']; ?>">
                                        <br />
                                        <input name="image" type="file" />
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: top; padding-top: 9px;">
                                        <label>Content</label>
                                    </td>
                                    <td>
                                        <textarea name="body" class="tinymce">
                                            <?= $resultDisplay['body']; ?>
                                        </textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Tags</label>
                                    </td>
                                    <td>
                                        <input type="text" name="tags" value="<?= $resultDisplay['tags']; ?>" class="medium" />
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Author</label>
                                    </td>
                                    <td>
                                        <input type="text" name="author" value="<?= $resultDisplay['author']; ?>" class="medium" />
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="submit" name="submit" Value="Save" />
                                    </td>
                                </tr>
                            </table>
            <?php
                        }
                    }
                }
            ?>          
            
            </form>
        </div>
    </div>
</div>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>

<?php include 'inc/footer.php'; ?>