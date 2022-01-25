<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php

if (!Session::get('role') == '0') {
    echo "<script> window.location = 'index.php'; </script>";
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <?php
        if (isset($_POST['submit'])) {
            $username = $fm->validation($_POST['username']);
            $password = $fm->validation(md5($_POST['password']));
            $email = $fm->validation($_POST['email']);
            $role = $fm->validation($_POST['role']);
            $username = mysqli_real_escape_string($db->link, $_POST['username']);
            $password = mysqli_real_escape_string($db->link, $_POST['password']);
            $email = mysqli_real_escape_string($db->link, $_POST['email']);
            $role = mysqli_real_escape_string($db->link, $_POST['role']);
            if ($username == '' || $password == '' || $role == '') {
                echo "Field Must Not Be Empty";
            } else {
                $query = "SELECT * FROM tbl_user WHERE email='$email'";
                $checkMail = $db->select($query);
                if ($checkMail != false) {
                    echo "<h5 style = 'color:red'>Email Already Exist!!</h5>";
                } else {
                    $query = "INSERT INTO tbl_user (username,password,email,role) VALUE ('$username', '" . md5($password) . "','$email','$role')";
                    $insert = $db->insert($query);
                    echo "<h5 style = 'color:green'>User Inserted Successfully!!</h5>";
                }
            }
        }
        ?>
        <div class="block copyblock">
            <form action="adduser.php" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input name="username" type="text" placeholder="Enter username.." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Password</label>
                        </td>
                        <td>
                            <input name="password" type="text" placeholder="Enter Password.." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input name="email" type="text" placeholder="Enter Email.." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Role</label>
                        </td>
                        <td>
                            <select id="select" class="form-control" name="role">
                                <option>Select Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Add User" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>