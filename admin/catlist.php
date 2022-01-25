<?php ob_start(); ?>
<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
$query = "SELECT * FROM tbl_cat ORDER BY id DESC";
$result = $db->select($query);
$x = 1;
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php
        if (isset($_GET['delcat'])) {
            $id = $_GET['delcat'];
            $query = "DELETE FROM tbl_cat WHERE id = $id";
            $deleteCat = $db->delete($query);
            if ($deleteCat) {
                header("Location: catlist.php ");
            } else {
                echo "<h5 style = 'color:red'>Something went wrong!!</h5>";
            }
        }

        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr class="odd gradeX">
                                <td><?php echo $x;
                                    $x++ ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>
                                    <a href="editcat.php?id=<?php echo $row['id']; ?>">Edit</a>
                                    ||
                                    <a onclick="return confirm('Are You Sure Want To Delete?')" href="?delcat=<?php echo $row['id']; ?>">Delete</a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include "inc/footer.php"; ?>
<?php ob_end_flush(); ?>