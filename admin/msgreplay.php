<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $to = $_POST['toEmail'];
        $from = $_POST['fromEmail'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];

        $sendmail = mail($to, $subject, $body, $from);
        if($sendmail) {
            echo "<span>Message sent successfully</span>";
        } else {
            echo "<span>Message sent failed</span>";
        }
    }
?>
<?php

    if (isset($_GET['msgId']) && $_GET['msgId'] != null) {
        $id = $_GET['msgId'];

        $queryShow = "SELECT * FROM tbl_contact WHERE id = '$id'";
        $temp = $db->select($queryShow);

        if($temp) {
            $msg = $temp->fetch_assoc();
        }
    } else {
        echo "<script>window.location = 'inbox.php';</script>";
    }
    
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>

        <div class="block">
            <form action="" method="post" id="replymsg">             
                <table class="form">
                    <tr>
                        <td>
                            <label>To</label>
                        </td>
                        <td>
                            <input type="text" readonly id="toEmail" name="toEmail" value="<?= $msg['email']; ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <input type="text" id="fromEmail" name="fromEmail" class="medium" placeholder="Enter your email..."/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                            <input type="text" id="subject" name="subject" placeholder="Enter Subject..." class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea id="body" name="body" class="tinymce" ></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Send">
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