<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
if (isset($_GET['userid'])) {
    $viewuser = $_GET['userid'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>View User</h2>
        <div class="block">
            <?php

            if (isset($_POST['submit'])) {
                echo "<script> window.location='userlist.php' </script>";
            }



            ?>
            <form action="" method="post">
                <?php
                $query = "SELECT * FROM tbl_user WHERE id= '$viewuser'";
                $selectUser = $db->select($query);
                if ($selectUser) {
                    while ($getUser = $selectUser->fetch_assoc()) { ?>
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $getUser['name']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>username</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $getUser['username']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $getUser['email']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Details</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $getUser['details']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="OK" />
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