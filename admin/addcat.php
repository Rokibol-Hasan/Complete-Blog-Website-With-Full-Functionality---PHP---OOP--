<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <?php
        if (isset($_POST['submit'])) {
            $catName = mysqli_real_escape_string($db->link, $_POST['catname']);
            if (empty($catName)) {
                echo "<h5 style = 'color:red'>Field Must Not Be Empty!!</h5>";
            } else {
                $query = "INSERT INTO tbl_cat (name) VALUE ('$catName')";
                $insert = $db->insert($query);
                echo "<h5 style = 'color:green'>Category Inserted Successfully!!</h5>";
            }
        }
        ?>
        <div class="block copyblock">
            <form action="addcat.php" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input name="catname" type="text" placeholder="Enter Category Name..." class="medium" />
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
<?php include "inc/footer.php"; ?>