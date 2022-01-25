<?php ob_start();?>
<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
if (isset($_GET['id'])) {
    $pageid = $_GET['id'];
}
?>
<?php
if (isset($_GET['delpage'])) {
    $id = $_GET['delpage'];
    $query = "DELETE FROM tbl_page WHERE id = $id";
    $delPage = $db->delete($query);
    if ($delPage) {
        header("Location:index.php");
    } else {
        echo "<h5 style = 'color:red'>Something went wrong!!</h5>";
    }
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Page Info</h2>
        <?php
        if (isset($_POST['submit'])) {
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            if ($name == "" || $body == "") {
                echo "<h5 style = 'color:red'>Field Must Not Be Empty!!</h5>";
            } else {
                $query = "
                UPDATE tbl_page
                SET
                name = '$name',
                body = '$body'
                WHERE id = $pageid
                ";
                $updatePage = $db->update($query);
                if ($updatePage) {
                    header("Location:index.php");
                } else {
                    echo "<span class='error'>Page Not Updated !</span>";
                }
            }
        }

        ?>
        <div class="block">
            <?php
            $query = "SELECT * FROM tbl_page WHERE id = '$pageid'";
            $result = $db->select($query);
            if ($result) {
                while ($row = $result->fetch_assoc()) { ?>
                    <form action="page.php?id=<?php echo $row['id']; ?>" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $row['name'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body"><?php echo $row['body'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="btn btn-info" type="submit" name="submit" Value="Save" />
                                    <a class="btn btn-success" onclick="return confirm('Are You Sure Want To Delete?')" href="?delpage=<?php echo $row['id']; ?>">Delete</a>
                                </td>
                            </tr>
                    <?php }
            } ?>
                        </table>
                    </form>
        </div>
    </div>
</div>
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include "inc/footer.php"; ?>
<?php ob_end_flush();?>