<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
if (isset($_GET['pid'])) {
    $getId = $_GET['pid'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if (isset($_POST['submit'])) {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            $author = mysqli_real_escape_string($db->link, $_POST['author']);
            $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
            $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/" . $unique_image;

            if ($title == "" || $cat == "" || $body == "" || $tags == "" || $author == "" || $file_name == "") {
                echo "<h5 style = 'color:red'>Field Must Not Be Empty!!</h5>";
            } elseif ($file_size > 1048567) {
                echo "<span class='error'>Image Size should be less then 1MB!</span>";
            } elseif (in_array($file_ext, $permited) === false) {
                echo "<span class='error'>You can upload only:-"
                    . implode(', ', $permited) . "</span>";
            } else {
                move_uploaded_file($file_temp, "upload/" . $unique_image);
                $query = "
                UPDATE tbl_post
                SET
                cat = '$cat',
                title = '$title',
                body = '$body',
                image = '$uploaded_image',
                author = '$author',
                tags = '$tags',
                userid = '$userid'

                WHERE id = $getId 
                ";
                $updatePost = $db->update($query);

                if ($updatePost) {
                    echo "<span class='success'>Post Updated Successfully.</span>";
                } else {
                    echo "<span class='error'>Post Not Updated !</span>";
                }
            }
        }

        ?>
        <div class="block">
            <form action="editpost.php?pid=<?php echo $getId; ?>" method="post" enctype="multipart/form-data">
                <?php
                $query = "SELECT * FROM tbl_post WHERE id= '$getId' ORDER BY id DESC";
                $selectResult = $db->select($query);
                if ($selectResult) {
                    while ($getPost = $selectResult->fetch_assoc()) { ?>
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" name="title" value="<?php echo $getPost['title']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="cat">
                                        <option>Select Category</option>
                                        <?php
                                        $query = "SELECT * FROM tbl_cat";
                                        $result = $db->select($query);
                                        while ($row = $result->fetch_assoc()) { ?>
                                            <option <?php
                                                    if ($getPost['cat'] == $row['id']) { ?> selected="selected" <?php } ?> value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="file" style="cursor: pointer;">Upload Image</label>
                                </td>
                                <td>
                                    <input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)"><br>
                                    <img class="img" id="output" src="<?php echo $getPost['image']; ?>" alt="post image" width="70px" height="50px">

                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body"><?php echo $getPost['body']; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tags</label>
                                </td>
                                <td>
                                    <input type="text" name="tags" value="<?php echo $getPost['tags']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Author</label>
                                </td>
                                <td>
                                    <input type="text" name="author" readonly value="<?php echo Session::get('username'); ?>" class="medium" />
                                    <input type="hidden" name="userid" readonly value="<?php echo Session::get('id'); ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
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