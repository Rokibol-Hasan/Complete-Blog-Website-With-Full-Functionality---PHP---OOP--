<?php ob_start(); ?>
<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Page</h2>
        <?php
        if (isset($_POST['submit'])) {
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);


            if ($name == "" || $body == "") {
                echo "<h5 style = 'color:red'>Field Must Not Be Empty!!</h5>";
            } else {
                $query = "INSERT INTO tbl_page(name,body) VALUES('$name','$body')";
                $addNewPage = $db->insert($query);
                if ($addNewPage) {
                    header("Location:index.php");
                } else {
                    echo "<span class='error'>Post Not Inserted !</span>";
                }
            }
        }

        ?>
        <div class="block">
            <form action="addpage.php" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" placeholder="Enter Page Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
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
<?php ob_end_flush(); ?>