<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<style>
    a.ok {
        border: 1px solid #ddd;
        color: #444;
        background: #f0f0f0;
        cursor: pointer;
        font-size: 20px;
        font-weight: normal;
        padding: 2px 10px;
    }
</style>
<?php

    if (isset($_GET['msgId']) && $_GET['msgId'] != null) {
        $id = $_GET['msgId'];

        $queryShow = "SELECT * FROM tbl_contact WHERE id = '$id'";
        $temp = $db->select($queryShow);

        if($temp) {
            $msg = $temp->fetch_assoc();
        }
    }
    
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>

        <div class="block">               
                <table class="form">
                    
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" readonly name="name" value="<?= $msg['firstname'] . ' ' . $msg['lastname']; ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" readonly name="email" value="<?= $msg['email']; ?>" class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Date</label>
                        </td>
                        <td>
                            <input type="text" readonly name="email" value="<?= $fm->dateFormat($msg['date']); ?>" class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea name="body" readonly cols="38" rows="12"><?= $msg['body']; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <a class="ok" href="inbox.php">Ok</a>
                            <a class="ok" href="msgreplay.php?msgId=<?= $msg['id']; ?>">Reply</a>
                        </td>
                    </tr>
                    
                </table>
        </div>
    </div>
</div>


<?php include 'inc/footer.php'; ?>