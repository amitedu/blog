<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php
            if (isset($_GET['delCatId']) && $_GET['delCatId'] != null) {
                $delCatId = $_GET['delCatId'];
                $delQuery = "DELETE FROM tbl_category WHERE id = $delCatId";
                if($db->delete($delQuery)) {
                    echo "<span class='success'>Deleted Successfully.</span>";
                } else {
                    echo "<span class='error'>Delete Unsuccess.</span>";
                }
            }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM tbl_category ORDER BY id DESC";
                    $category = $db->select($query);

                    if($category) {
                        $i = 0;
                        while($result = mysqli_fetch_array($category)) {
                            $i++;
                ?>
                            <tr class="odd gradeX">
                                <td><?=$i?></td>
                                <td><?= $result['name'] ?></td>
                                <td><a href="editcat.php?catId=<?=$result['id']?>">Edit</a> || <a onclick="return confirm('are you sure to Delete !'); " href="?delCatId=<?=$result['id']?>">Delete</a></td>
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

<script type="text/javascript">

    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script>

<?php include 'inc/footer.php'; ?>
