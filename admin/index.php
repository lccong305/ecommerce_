<?php
include('../config/config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../asset/reset.css?<?php echo time() ?>">
    <link rel="stylesheet" href="../asset/admin.css?<?php echo time() ?>">
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
</head>

<body>
    <div class="login-admin">
        <div class="login-admin__header">
            Dang nhap trang quan tri
        </div>
        <form method="POST" action="./handler.php">
            <div class="error_login">
                <?php
                if (isset($_SESSION['login_error'])) {
                    echo $_SESSION['login_error'];
                }
                ?>
            </div>
            <div class="wrap_login">
                <label for="uname"><b>Username</b></label>
                <input class="form_usn_login" type="text" placeholder="Enter Username" name="uname" required>

                <label for="psw"><b>Password</b></label>
                <input class="form_psw_login" type="password" placeholder="Enter Password" name="psw" required>

                <input class="sbm_login_form" name="sbm_login_admin" Value="Login" type="submit" />
            </div>
        </form>
    </div>
</body>

<link rel="stylesheet" href="../asset/js/bootstrap.min.js">
</html>