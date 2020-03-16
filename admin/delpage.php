<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php

    if (isset($_GET['delPageId']) && $_GET['delPageId'] != NULL) {
        $id = $_GET['delPageId'];

        $query = "DELETE FROM tbl_page WHERE id = '$id'";
        
        if($db->delete($query)) {
            echo "<script>alert('Delete Successful?');</script>";
            echo "<script>window.location = 'index.php';</script>";
        } else {
            echo "<script>alert('Delete Successful?');</script>";
            echo "<script>window.location = 'index.php';</script>";
        }
    }
    


?>

<?php include 'inc/footer.php'; ?>