<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
if (isset($_GET['id'])) {
    $msgid = $_GET['id'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2></h2>
        <div class="block">
            <?php
            if (isset($_POST['submit'])) {
                $toEmail = $fm->validation($_POST['toEmail']);
                $fromEmail = $fm->validation($_POST['fromEmail']);
                $subject = $fm->validation($_POST['subject']);
                $body = $fm->validation($_POST['body']);

                $sendMail = mail($toEmail, $subject, $body, $fromEmail);

                if ($sendMail) {
                    echo "<script> alert('Reply Sent') </script>";
                } else {
                    echo "Something Went Wrong";
                }
            }
            ?>
            <form action="replymsg.php?id=<?php echo $msgid; ?>" method="post">
                <?php
                $query = "SELECT * FROM tbl_contact WHERE id= '$msgid'";
                $selectMsg = $db->select($query);
                if ($selectMsg) {
                    while ($msg = $selectMsg->fetch_assoc()) { ?>
                        <table class="form">
                            <tr>
                                <td>
                                    <label>To</label>
                                </td>
                                <td>
                                    <input type="text" readonly name="toEmail" value="<?php echo $msg['email']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>From</label>
                                </td>
                                <td>
                                    <input type="text" name="fromEmail" placeholder="Enter Your Email Address..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Subject</label>
                                </td>
                                <td>
                                    <input type="text" name="subject" placeholder="Enter Your Email Subject..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Message Body</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body"> </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-control btn btn-success" type="submit" name="submit" value="Send">
                                </td>
                            </tr>
                        </table>
                <?php }
                } ?>
            </form>
        </div>
    </div>
</div>
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>

<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include "inc/footer.php"; ?>