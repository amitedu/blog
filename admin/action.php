<?php
    include '../config/config.php';
    include '../lib/Database.php'; 

    $db = new Database();
?>

<?php

if (isset($_GET['seenId']) && $_GET['seenId'] != null) {
    $id = $_GET['seenId'];

    $query = "UPDATE tbl_contact SET status = 1 WHERE id = '$id'";

    if ($db->update($query)) {
        echo "<span style='color: green; font-size: 18px;'>Update Successful.</span>";
    } else {
        echo "<span style='color: red; font-size: 18px;'>Update failed.</span>";
    }
    
} elseif (isset($_GET['unseenId']) && $_GET['unseenId'] != null) {
    $id = $_GET['unseenId'];

    $query = "UPDATE tbl_contact SET status = 0 WHERE id = '$id'";

    if ($db->update($query)) {
        echo "<span style='color: green; font-size: 18px;'>Update Successful.</span>";
    } else {
        echo "<span style='color: red; font-size: 18px;'>Update failed.</span>";
    }
}









?>