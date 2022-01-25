<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<style>
    .leftside {
        float: left;
        width: 70%;
    }

    .rightside {
        float: left;
        width: 30%;
    }

    .rightside img {
        height: 80px;
        width: 150px;
    }
</style>
<div class="grid_10">
    <?php
    if (isset($_POST['submit'])) {
        $title = mysqli_real_escape_string($db->link, $_POST['title']);
        $slogan = mysqli_real_escape_string($db->link, $_POST['slogan']);

        $permited  = array('png');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $sameImage = 'logo'.'.'. $file_ext;
        $uploaded_image = "upload/" . $sameImage;

        if ($title == "" || $slogan == "" || $file_name == "") {
            echo "<h5 style = 'color:red'>Field Must Not Be Empty!!</h5>";
        } elseif ($file_size > 1048567) {
            echo "<span class='error'>Image Size should be less then 1MB!</span>";
        } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-"
                . implode(', ', $permited) . "</span>";
        } else {
            move_uploaded_file($file_temp, "upload/" . $sameImage);
            $query = "
                UPDATE title_slogan
                SET
                title = '$title',
                slogan = '$slogan',
                image = '$uploaded_image'
                WHERE id = 1
                ";
            $updateTitleSlogan = $db->update($query);

            if ($updateTitleSlogan) {
                echo "<span class='success'>Title Slogan Updated Successfully.</span>";
            } else {
                echo "<span class='error'>Title Slogan Not Updated !</span>";
            }
        }
    }

    ?>
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock">
            <div class="leftside">
                <form action="titleslogan.php" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <?php
                        $query = "SELECT * FROM title_slogan WHERE id = 1";
                        $result = $db->select($query);
                        if ($result) {
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td>
                                        <label>Website Title</label>
                                    </td>
                                    <td>
                                        <input type="text" name="title" class="medium" value="<?php echo $row['title'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Website Slogan</label>
                                    </td>
                                    <td>
                                        <input type="text" name="slogan" class="medium" value="<?php echo $row['slogan'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Logo</label>
                                    </td>
                                    <td>
                                        <input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)"><br>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="btn btn-info" type="submit" name="submit" Value="Update" />
                                    </td>
                                </tr>
                    </table>
                </form>
            </div>
            <div class="rightside">
                <div class="logo">
                    <img class="img" id="output" src="<?php echo $row['image']; ?>" alt="logo">
                </div>
            </div>
    <?php }
                        } ?>
        </div>
    </div>
</div>
<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
<?php include "inc/footer.php"; ?>