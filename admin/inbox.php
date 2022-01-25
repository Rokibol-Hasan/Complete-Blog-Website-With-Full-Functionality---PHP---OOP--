<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php   

if (!Session::get('role')=='0') {
    echo "<script> window.location = 'index.php'; </script>";
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">
            <?php
            if (isset($_GET['seenid'])) {
                $msgid = $_GET['seenid'];
                $query = "UPDATE tbl_contact 
                SET
                status = '1'
                WHERE id = '$msgid'
                ";
                $updateStatus = $db->update($query);
                if ($updateStatus) {
                    echo "Msg Sent To SEEN section";
                } else {
                    echo "something went wrong";
                }
            }

            if (isset($_GET['delid'])) {
                $delId = $_GET['delid'];

                $query = "DELETE FROM tbl_contact WHERE id='$delId'";
                $deleteId = $db->delete($query);
                if ($deleteId) {
                    echo "Msg Deleted";
                } else {
                    echo "Msg Can't Be Deleted";
                }
            }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Body</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $x = 1;
                    $query = "SELECT * FROM tbl_contact WHERE status='0'";
                    $result = $db->select($query);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr class="odd gradeX">
                                <td><?php echo $x;
                                    $x++ ?></td>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $fm->textshorten($row['body'], 20); ?></td>
                                <td><?php echo $fm->formatdate($row['date']); ?></td>
                                <td>
                                    <a href="viewmsg.php?id=<?php echo $row['id']; ?> ">View</a>
                                    |
                                    <a href="replymsg.php?id=<?php echo $row['id']; ?>">Reply</a>
                                    |
                                    <a href="?seenid=<?php echo $row['id']; ?>">Seen</a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Viewed Message</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Body</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $x = 1;
                    $query = "SELECT * FROM tbl_contact WHERE status='1'";
                    $result = $db->select($query);
                    if ($result) {
                        while ($seen = $result->fetch_assoc()) { ?>
                            <tr class="odd gradeX">
                                <td><?php echo $x;
                                    $x++ ?></td>
                                <td><?php echo $seen['firstname']; ?></td>
                                <td><?php echo $seen['lastname']; ?></td>
                                <td><?php echo $seen['email']; ?></td>
                                <td><?php echo $fm->textshorten($seen['body'], 20); ?></td>
                                <td><?php echo $fm->formatdate($seen['date']); ?></td>
                                <td>
                                    <a href="viewmsg.php?id=<?php echo $seen['id']; ?> ">View</a>
                                    |
                                    <a href="?delid=<?php echo $seen['id']; ?>">Delete</a>
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