<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $title  = mysqli_real_escape_string($db->link, $_POST['title']);
                $cat    = mysqli_real_escape_string($db->link, $_POST['cat']);
                $body   = mysqli_real_escape_string($db->link, $_POST['body']);
                $tags   = mysqli_real_escape_string($db->link, $_POST['tags']);
                $author = mysqli_real_escape_string($db->link, $_POST['author']);

                $permitted = ['jpg', 'jpeg', 'png', 'gif'];
                $imageName = $_FILES['image']['name'];
                $imageSize = $_FILES['image']['size'];
                $imageTemp = $_FILES['image']['tmp_name'];

                $div = explode('.', $imageName);
                $imageExt = strtolower(end($div));
                
                if (empty($title) || empty($cat) || empty($body) || empty($tags) || empty($author) || empty($imageName)) {
                    echo "Feild can not be empty !";
                } elseif (!in_array($imageExt, $permitted)) {
                    echo "Upload image only with : " . implode(", ", $permitted);
                } elseif ($imageSize > 1000000) {
                    echo "Image size must be under 1 MB";
                } else {
                    $uniqueName = uniqid();
                    $uploadedImage = "uploads/" . $uniqueName . "." . $imageExt;
                    if (move_uploaded_file($imageTemp, $uploadedImage)) {
                        $query = "INSERT INTO tbl_post(cat, title, body, image, author, tags) VALUES('$cat', '$title', '$body', '$uploadedImage', '$author', '$tags')";
                        
                        if ($db->insert($query)) {
                            echo "Post Inserted Successfully.";
                        }
                    }
                }
            }
        ?>
        <div class="block">               
            <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">
                
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
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
                                $query = "SELECT * FROM tbl_category";
                                $category = $db->select($query);
                                if($category) {
                                    while($result = mysqli_fetch_array($category)) {
                            ?>
                                        <option value="<?=$result['id'];?>"><?=$result['name'];?></option>
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
                        <input name="image" type="file" />
                    </td>
                </tr>

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Tags</label>
                    </td>
                    <td>
                        <input type="text" name="tags" placeholder="Enter tags name..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Author</label>
                    </td>
                    <td>
                        <input type="text" name="author" placeholder="Enter Author name..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
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