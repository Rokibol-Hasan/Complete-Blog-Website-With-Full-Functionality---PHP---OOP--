<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">
    <div class="box round first grid">
        <?php
        if (isset($_POST['submit'])) {
            $copyright = mysqli_real_escape_string($db->link, $_POST['copyright']);

            if ($copyright == "") {
                echo "<h5 style = 'color:red'>Field Must Not Be Empty!!</h5>";
            } else {
                $query = "
                UPDATE copyright
                SET
                copyright = '$copyright'
                WHERE id = 1
                ";
                $updateCopyRight = $db->update($query);

                if ($updateCopyRight) {
                    echo "<span class='success'>Copyright Updated Successfully.</span>";
                } else {
                    echo "<span class='error'>Copyright Not Updated !</span>";
                }
            }
        }

        ?>
        <h2>Update Copyright Text</h2>
        <div class="block copyblock">
            <form action="copyright.php" method="post">
                <table class="form">
                    <?php
                    $query = "SELECT * FROM copyright WHERE id = 1";
                    $result = $db->select($query);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $row['copyright'] ?>" name="copyright" class="large" />
                                </td>
                            </tr>

                            <tr>
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
<div class="clear">
</div>
</div>
<?php include "inc/footer.php"; ?>