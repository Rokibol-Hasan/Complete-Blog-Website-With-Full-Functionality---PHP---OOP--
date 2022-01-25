<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">
    <?php
    if (isset($_POST['submit'])) {
        echo "<script> window.location='postlist.php' </script>";
    }

    ?>
    <div class="box round first grid">
        <h2>Desire Post</h2>
        <div class="block">
            <form action="" method="post">
                <?php
                if (isset($_GET['pid'])) {
                    $postid = $_GET['pid'];
                    $query = "SELECT * FROM tbl_post WHERE id='$postid'";
                    $result = $db->select($query);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <table class="form">
                                <tr>
                                    <td>
                                        <label>Title</label>
                                    </td>
                                    <td>
                                        <input type="text" readonly value="<?php echo $row['title'] ?> " class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Category</label>
                                    </td>
                                    <td>
                                        <select id="select">
                                            <?php
                                            $query = "SELECT * FROM tbl_cat";
                                            $result = $db->select($query);
                                            while ($getCat = $result->fetch_assoc()) { ?>
                                                <option> <?php echo $getCat['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Image</label>
                                    </td>
                                    <td>
                                        <img src="<?php echo $row['image'] ?>" hight='70px' width='80px'>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top; padding-top: 9px;">
                                        <label>Content</label>
                                    </td>
                                    <td>
                                        <textarea readonly class="tinymce"> <?php echo $row['body'] ?> </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Tags</label>
                                    </td>
                                    <td>
                                        <input type="text" readonly value="<?php echo $row['tags'] ?>" class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Author</label>
                                    </td>
                                    <td>
                                        <input type="text" readonly value="<?php echo $row['author'] ?>" class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="submit" name="submit" Value="Ok" />
                                    </td>
                                </tr>
                    <?php }
                    }
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