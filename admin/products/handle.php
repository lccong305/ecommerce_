<?php
include("../../config/config.php");
session_start();
// ========================================== insert product ===================
if (isset($_POST['sbm_add_prd'])) {

    echo   $name = $_POST['nameprd'];

    $query = "SELECT * FROM products WHERE name = '$name'";
    $result = $conn->query($query);
    if (mysqli_num_rows($result) != 0) {
        $_SESSION['waring'] = "Da ton tai ten san pham!";
        header("location:../dashboard.php?req=product");
    } else {
        $cate = $_POST['cateid'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];
        $status = $_POST['status'];

        $path = "./uploads/";
        $imageName = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $exp3 = substr($imageName, strlen($imageName) - 3);
        $exp4 = substr($imageName, strlen($imageName) - 4);
        if ($exp3 == 'jpg' || $exp3 == 'png' || $exp3 == 'bmp' || $exp3 == 'gif' || $exp4 == 'jpeg' || $exp4 == 'webp') {
            $imageName = time() . '_' . $imageName;
            move_uploaded_file($image_tmp, $path . $imageName);
            echo $imageName;
            $query = "INSERT INTO products(id_cate,name,image,price,description,status) VALUES('$cate','$name','$imageName','$price','$desc','$status')";
            $result = $conn->query($query);
            header("location:../dashboard.php?req=product");
            unset($_SESSION['waring']);
            unset($_SESSION['waring_img']);
        } else {
            $_SESSION['waring_img'] = "Hinh anh khong hop le!";
            header("location:../dashboard.php?req=product");
        }
    }
}

// ======================================= update product ===================
if (isset($_POST['sbm_update_prd'])) {
    $id = $_GET['id'];
    $name = $_POST['nameprd'];
    $rowprd = mysqli_fetch_array($conn->query("SELECT * FROM products WHERE id = '$id'"));

    $query = "SELECT * FROM products WHERE name = '$name' AND id !=" . $rowprd['id'];
    $result = $conn->query($query);
    if (mysqli_num_rows($result) != 0) {
        $_SESSION['waring'] = "Da ton tai ten san pham!";
        header("location:../dashboard.php?req=product");
    } else {
        $id_cate = $_POST['cateid'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];
        $status = $_POST['status'];

        $path = "./uploads/";
        $imageName = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $exp3 = substr($imageName, strlen($imageName) - 3);
        $exp4 = substr($imageName, strlen($imageName) - 4);
        if ($exp3 == 'jpg' || $exp3 == 'png' || $exp3 == 'bmp' || $exp3 == 'gif' || $exp4 == 'jpeg' || $exp4 == 'webp') {
            $imageName = time() . '_' . $imageName;
            move_uploaded_file($image_tmp, $path . $imageName);
            unlink($path . $rowprd['image']);
        } else {
            $_SESSION['waring_img'] = "Hinh anh khong hop le!";
            echo "hinh khong hop le";
            header("location:../dashboard.php?req=product");
        }
        if (empty($imageName)) {
            $imageName = $rowprd['image'];
        }
    }

    $query = "UPDATE products SET id_cate = '$id_cate',name = '$name',image='$imageName' ,price='$price',description = '$desc',status = '$status' WHERE id = '$id'";
    $result = $conn->query($query);
    header("location:../dashboard.php?req=product");
    unset($_SESSION['waring']);
    unset($_SESSION['waring_img']);
}

// ====================================== Delete Products =================
if (isset($_GET['act']) == 'delete-product') {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM order_details WHERE product_id = '$id'");
    if (mysqli_num_rows($result) != 0) {
        $query = "UPDATE products SET status = 0 WHERE id = '$id'";
        $result = $conn->query($query);
        header("location: ../dashboard.php?req=product");
    } else {
        $query = "DELETE FROM products WHERE id = '$id'";
        $result = $conn->query($query);
        if ($result) {
            header("location:../dashboard.php?req=product");
        }
    }
} else {
    echo "The system error";
}
