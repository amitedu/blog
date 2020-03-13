<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    if (!isset($_GET['catId']) || $_GET['catId'] == null) {
        echo "<script>window.location = 'catlist.php';</script>";
    } else {
        $id = $_GET['catId'];
    }
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Category</h2>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                $name = $_POST['name'];
                $name = mysqli_real_escape_string($db->link, $name);

                if (empty($name)) {
                    echo "<span class='error'>Feild must not be empty !</span>";
                } else {
                    $query = "UPDATE tbl_category SET name = '$name' WHERE id = '$id'";

                    if ($db->insert($query)) {
                        echo "<span class='success'>Category Inserted Successfully.</span>";
                    } else {
                        echo "<span class='error'>Category not Inserted !</span>";
                    }
                }
            }
        ?>
        <div class="block copyblock"> 
            <?php
                $query = "SELECT * FROM tbl_category WHERE id = $id";
                $category = $db->select($query);
                if ($category) {
                    $result = mysqli_fetch_array($category);
                } else {
                    echo "Error";
                    die();
                }
            ?>
            <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="name" value="<?= $result['name']; ?>" class="medium" />
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