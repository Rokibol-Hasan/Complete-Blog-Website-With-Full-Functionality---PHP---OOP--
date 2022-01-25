<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">
            <?php
            if (isset($_POST['submit'])) {
                $facebook = mysqli_real_escape_string($db->link, $_POST['facebook']);
                $twitter = mysqli_real_escape_string($db->link, $_POST['twitter']);
                $linkedin = mysqli_real_escape_string($db->link, $_POST['linkedin']);
                $gplus = mysqli_real_escape_string($db->link, $_POST['gplus']);
                if ($facebook == "" || $twitter == "" || $linkedin == "" || $gplus == "") {
                    echo "<h5 style = 'color:red'>Field Must Not Be Empty!!</h5>";
                } else {
                    $query = "
                UPDATE social_media
                SET
                facebook = '$facebook',
                twitter = '$twitter',
                linkedin = '$linkedin',
                gplus = '$gplus'
                WHERE id = 1 
                ";
                    $setSocial = $db->update($query);

                    if ($setSocial) {
                        echo "<span class='success'>Social Media Updated Successfully.</span>";
                    } else {
                        echo "<span class='error'>Social Media Not Updated !</span>";
                    }
                }
            }

            ?>
            <form action="social.php" method="post">
                <table class="form">
                    <?php
                    $query = "SELECT * FROM social_media WHERE id = 1";
                    $result = $db->select($query);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <label>Facebook</label>
                                </td>
                                <td>
                                    <input type="text" name="facebook" value="<?php echo $row['facebook']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Twitter</label>
                                </td>
                                <td>
                                    <input type="text" name="twitter" value="<?php echo $row['twitter']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>LinkedIn</label>
                                </td>
                                <td>
                                    <input type="text" name="linkedin" value="<?php echo $row['linkedin']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Google Plus</label>
                                </td>
                                <td>
                                    <input type="text" name="gplus" value="<?php echo $row['gplus']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>