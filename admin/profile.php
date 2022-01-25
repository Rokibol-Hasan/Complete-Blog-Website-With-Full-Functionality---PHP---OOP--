<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php 
if (isset($_GET['userid'])) {
    $viewuser = $_GET['userid'];
}
?>
<?php
$userid = Session::get('id');
$userrole = Session::get('role');
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update User</h2>
        <?php
        if (isset($_POST['submit'])) {
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $username = mysqli_real_escape_string($db->link, $_POST['username']);
            $email = mysqli_real_escape_string($db->link, $_POST['email']);
            $details = mysqli_real_escape_string($db->link, $_POST['details']);
            if ($name == '' || $username == '' || $email == '' || $details == '') {
                echo "Field Must Not Be Empty!";
            } else {
                $query = "
                UPDATE tbl_user
                SET
                name = '$name',
                username = '$username',
                email = '$email',
                details = '$details'
                WHERE id = $userid 
                ";
                $updateUser = $db->update($query);

                if ($updateUser) {
                    echo "<span class='success'>User Updated Successfully.</span>";
                } else {
                    echo "<span class='error'>User Not Updated !</span>";
                }
            }
        }
        ?>
        <div class="block">
            <form action="" method="post">
                <?php
                $query = "SELECT * FROM tbl_user WHERE id= '$userid' AND role='$userrole'";
                $selectUser = $db->select($query);
                if ($selectUser) {
                    while ($getUser = $selectUser->fetch_assoc()) { ?>
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $getUser['name']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>username</label>
                                </td>
                                <td>
                                    <input type="text" name="username" value="<?php echo $getUser['username']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $getUser['email']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Details</label>
                                </td>
                                <td>
                                    <input type="text" name="details" value="<?php echo $getUser['details']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
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