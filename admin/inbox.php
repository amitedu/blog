<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if (isset($_GET['seenId']) && $_GET['seenId'] != null) { // For seen to unseen message
        $id = $_GET['seenId'];
    
        $query = "UPDATE tbl_contact SET status = 1 WHERE id = '$id'";
    
        if ($db->update($query)) {
            $response = "<span style='color: green; font-size: 18px;'>Update Successful.</span>";
        } else {
            $response =  "<span style='color: red; font-size: 18px;'>Update failed.</span>";
        }
        
    } elseif (isset($_GET['unseenMsgId']) && $_GET['unseenMsgId'] != null) { // For unseen to seen msg
        $id = $_GET['unseenMsgId'];
    
        $query = "UPDATE tbl_contact SET status = 0 WHERE id = '$id'";
    
        if ($db->update($query)) {
            $response = "<span style='color: green; font-size: 18px;'>Unseen Successful.</span>";
        } else {
            $response = "<span style='color: red; font-size: 18px;'>Unseen failed.</span>";
        }
    } elseif (isset($_GET['unseenDelId']) && $_GET['unseenDelId'] != null) { // For delete unseen msg
        $id = $_GET['unseenDelId'];
    
        $query = "DELETE FROM tbl_contact WHERE id = '$id'";
    
        if ($db->update($query)) {
            $response = "<span style='color: green; font-size: 18px;'>Delete Successful.</span>";
        } else {
            $response = "<span style='color: red; font-size: 18px;'>Delete failed.</span>";
        }
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div><?= isset($response) ? $response : ''; ?></div>
        <div class="block">        
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th width="10%">Serial No.</th>
                    <th width="15%">Name</th>
                    <th width="15%">Email</th>
                    <th width="20%">Message</th>
                    <th width="20%">Date</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $queryShow = "SELECT * FROM tbl_contact WHERE status = 0";
                    $temp = $db->select($queryShow);

                    if ($temp) {
                        $i = 0;
                        while($message = $temp->fetch_assoc()) {
                            $i++;
                ?>
                            <tr class="odd gradeX">
                                <td><?= $i; ?></td>
                                <td><?= $message['firstname'] . ' '. $message['lastname']; ?></td>
                                <td><?= $message['email']; ?></td>
                                <td><?= $fm->dateFormat($message['date']); ?></td>
                                <td><?= $fm->shortText($message['body'], 30); ?></td>
                                <td>
                                    <a href="msgview.php?msgId=<?= $message['id']; ?>">View</a> 
                                    || 
                                    <a href="msgreplay.php?msgId=<?= $message['id']; ?>">Replay</a> 
                                    || 
                                    <a id="seen" href="?seenId=<?= $message['id']; ?>">Seen</a>
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

<div class="grid_10">
    <div class="box round first grid">
        <h2>Seen Messages</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th width="10%">Serial No.</th>
                    <th width="15%">Name</th>
                    <th width="15%">Email</th>
                    <th width="20%">Message</th>
                    <th width="20%">Date</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $queryShow = "SELECT * FROM tbl_contact WHERE status = 1";
                    $temp = $db->select($queryShow);

                    if ($temp) {
                        $i = 0;
                        while($seenMessage = $temp->fetch_assoc()) {
                            $i++;
                ?>
                            <tr class="odd gradeX">
                                <td><?= $i; ?></td>
                                <td><?= $seenMessage['firstname'] . ' '. $seenMessage['lastname']; ?></td>
                                <td><?= $seenMessage['email']; ?></td>
                                <td><?= $fm->dateFormat($seenMessage['date']); ?></td>
                                <td><?= $fm->shortText($seenMessage['body'], 30); ?></td>
                                <td><a href="?unseenMsgId=<?= $seenMessage['id']; ?>">Unseen</a> || <a href="?unseenDelId=<?= $seenMessage['id']; ?>">Delete</a></td>
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

<script>
    // function test(seenId) {
    //     let url = 'action.php?seenId=' + seenId;

    //     fetch(url)
    //     .then((response) => response.text())
    //     .then((data) => {
    //         window.location.reload();
    //         document.getElementById('msg').innerHTML = data;
    //     })
        
    // }
</script>

<?php include 'inc/footer.php'; ?>
