<?php
include "../lib/session.php";
Session::checkLogin();
?>
<?php include "../config/config.php"; ?>
<?php include "../lib/Database.php"; ?>
<?php include "../helpers/format.php"; ?>
<?php
$db = new Database();
$fm = new format();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
    <div class="container">
        <section id="content">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $fm->validation($_POST['email']);
                $email = mysqli_real_escape_string($db->link, $email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "Enter A Valid Email";
                } else {
                    $mailQuery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
                    $mailCheck = $db->select($mailQuery);
                    if ($mailCheck != false) {
                        while ($value = $mailCheck->fetch_assoc()) {
                            $userid = $value['id'];
                            $username = $value['username'];
                        }
                        $text = substr($email, 0, 3);
                        $rand = rand(10000, 99999);
                        $newPass = "$text$rand";
                        $password = md5($newPass);
                        $updateQuery = "UPDATE tbl_user
                        SET
                        password = '$password'
                        WHERE id = '$userid'
                        ";
                        $updateRow = $db->update($updateQuery);

                        $to = "$email";
                        $from = "rokibol.hasancse@gmail.com";
                        $headers = "From:$from\n";
                        $headers .= 'MIME-Version:1.0' . "\r\n";
                        $headers .= 'Content-type:text/html;charset=iso-8859-1' . "\r\n";
                        $subject = "Your Password";
                        $mesage = "Your User Name Is" . $username . " and Password is" . $newPass . "Please Visit Website To Login";
                        $sendMail = mail($to, $subject, $headers);
                        if ($sendMail) {
                            echo "Mail Sent Successfully";
                        }else{
                            echo "Email Not Sent ";
                        }
                    } else {
                        echo "<script> alert('Email Not Matched') </script>";
                    }
                }
            }
            ?>
            <form action="" method="post">
                <h1>Password Recovery</h1>
                <div>
                    <input type="text" placeholder="Email" required="" name="email" />
                </div>
                <div>
                    <input type="submit" value="Send" />
                </div>
            </form><!-- form -->
            <div class="button">
                <a href="login.php">Login</a>
                <a href="#">Blog By Rokibol Hasan</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>
<script src="https://js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>

</html>