<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
if (isset($_GET['id'])) {
    $getId = $_GET['id'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <?php
        if (isset($_POST['submit'])) {
            $catName = mysqli_real_escape_string($db->link, $_POST['catname']);
            if (empty($catName)) {
                echo "<h5 style = 'color:red'>Field Must Not Be Empty!!</h5>";
            } else {
                $query = "
                UPDATE tbl_cat
                SET
                name = '$catName'
                WHERE id = $getId
                ";
                $updateCat = $db->update($query);
                echo "<h5 style = 'color:green'>Category updated Successfully!!</h5>";
            }
        }
        ?>
        <div class="block copyblock">
            <form action="editcat.php?id=<?php echo $getId; ?>" method="post">
                <table class="form">
                    <?php
                    $query = "SELECT * FROM tbl_cat WHERE id = '$getId' ORDER BY id DESC";
                    $result = $db->select($query);
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td>
                                <input name="catname" type="text" class="medium" value="<?php echo $row['name']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submit" Value="Update">
                            </td>
                        </tr>
                    <?php }
                    ?>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>