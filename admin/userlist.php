<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php

if (!Session::get('role') == '0') {
    echo "<script> window.location = 'index.php'; </script>";
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <?php
                $userid = Session::get('id');
                $userrole = Session::get('role');
                if (isset($_GET['deluser'])) {
                    $deluserid = $_GET['deluser'];
                    $query = "DELETE FROM tbl_user WHERE id='$deluserid'";
                    $delUser = $db->delete($query);
                    if ($delUser) {
                        echo "User Deleted Successfully!";
                    } else {
                        echo "Something Went Wrong";
                    }
                }

                ?>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>username</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $x = 1;
                    $query = "SELECT * FROM tbl_user";
                    $selectUser = $db->select($query);
                    if ($selectUser) {
                        while ($row = $selectUser->fetch_assoc()) { ?>
                            <tr class="odd gradeX">
                                <td><?php echo $x;
                                    $x++ ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['details']; ?></td>
                                <td><?php
                                    if ($row['role'] == '0') {
                                        echo "Admin";
                                    } elseif ($row['role'] == '1') {
                                        echo "Author";
                                    } elseif ($row['role'] == '2') {
                                        echo "Editor";
                                    }
                                    ?></td>
                                <td>
                                    <a href="viewuser.php?userid=<?php echo $row['id']; ?>">View</a>
                                    ||
                                    <a onclick="return confirm('Are You Sure Want To Delete?')" href="userlist.php?deluser=<?php echo $row['id']; ?>">Delete<a>
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