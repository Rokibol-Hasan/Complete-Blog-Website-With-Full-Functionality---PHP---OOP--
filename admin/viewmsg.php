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
            <form action="viewmsg.php?id=<?php echo $msgid; ?>" method="post" enctype="multipart/form-data">
                <?php
                $query = "SELECT * FROM tbl_contact WHERE id= '$msgid'";
                $selectMsg = $db->select($query);
                if ($selectMsg) {
                    while ($msg = $selectMsg->fetch_assoc()) { ?>
                        <table class="form">
                            <tr>
                                <td>
                                    <label>First Name</label>
                                </td>
                                <td>
                                    <input type="text" name="firstname" value="<?php echo $msg['firstname']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Last Name</label>
                                </td>
                                <td>
                                    <input type="text" name="firstname" value="<?php echo $msg['lastname']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $msg['email']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Message Body</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body"><?php echo $msg['body']; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Date</label>
                                </td>
                                <td>
                                    <input type="text" name="tags" value="<?php echo $fm->formatdate($msg['date']); ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a class="btn btn-success" href="inbox.php">Ok</a>
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