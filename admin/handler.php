<?php
include('../config/config.php');
session_start();
if (isset($_GET['act']) == 'delete-cate') {
    $id = $_GET['id'];
    echo $id;
    $query_prd = "SELECT * FROM products WHERE id_cate = '$id'";
    $check = $conn->query($query_prd);
    if (mysqli_num_rows($check) != 0) {
        $query = "UPDATE products SET status = 0 WHERE id_cate = '$id'";
        $result = $conn->query($query);
        $_SESSION['error_del_cate'] = "Van con san pham";
        header("location:./dashboard.php?req=home");
    } else {
        $query = "DELETE FROM category WHERE id = '$id'";
        $result = $conn->query($query);
        if ($result) {
            header("location:./dashboard.php?req=home");
        }
    }
}

if (isset($_POST['sbm_login_admin'])) {
    $uname = $_POST['uname'];
    $psw = $_POST['psw'];

    $query = "SELECT * FROM tbl_admin WHERE uname = '$uname' AND psw = '$psw'";
    $result = $conn->query($query);
    $row = mysqli_fetch_array($result);
    if (mysqli_num_rows($result) > 0) {
        if ($row['status'] == 0) {
            $_SESSION['login_error'] = "Tai khoan da bi khoa! Vui long lien he anh cong";
            header("location: ./index.php");
        } else {
            $_SESSION['admin_id'] = $row['id'];
            header("location:./dashboard.php?req=home");
        }
    } else {
        $_SESSION['login_error'] = "Sai ten dang nhap hoac mat khau!";
        header("location: index.php");
    }
}

if (isset($_POST['sbm_add_category'])) {
    $name = $_POST['namecate'];
    $desc = $_POST['desc'];
    $status = $_POST['status'];
    $query = "INSERT INTO category(name,description, status) VALUES ('$name','$desc','$status')";
    $result = $conn->query($query);
    if ($result) {
        header("location:./dashboard.php?req=home");
    }
}
if (isset($_POST['sbm_update_category'])) {
    $id = $_POST['update_category_id'];
    $name =  $_POST['namecate'];
    $desc = $_POST['desc'];
    $query = "UPDATE category SET name='$name', description='$desc' WHERE id = '$id'";
    $result = $conn->query($query);
    if ($result) {
        header("location:./dashboard.php?req=home");
    }
}
if (isset($_POST['sbm_update_cate'])) {
    $id = $_GET['id'];
    echo   $name = $_POST['namecate'];
    echo  $desc = $_POST['desc'];
    echo $status = $_POST['status'];

    $query = "UPDATE category SET name='$name', description='$desc', status='$status' WHERE id = '$id'";
    $result = $conn->query($query);
    if ($result) {
        header("location:./dashboard.php?req=home");
    }
} else {
    echo "Not find";
}
