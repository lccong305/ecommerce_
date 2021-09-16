<?php
include ("../../config/config.php");
session_start();

$act = isset($_GET['act'])? $_GET['act']:'';
$id = isset($_GET['id'])? $_GET['id']:'';


    if(isset($_POST['sbm_save_order'])){
         $status = $_POST['status'];
         $id = $_GET['id'];
        $query = "UPDATE tbl_orders SET status = '$status' WHERE id = '$id'";
        $result = $conn->query($query);
        if($result){
            header("Location: ../dashboard.php?req=order-detail&id=$id&stt=$status");
        }
    }
    if($act == 'delete-order'){
        $conn->query("DELETE FROM order_details WHERE order_id = '$id'");
        $conn->query("DELETE FROM tbl_orders WHERE id = '$id'");
        header("Location: ../dashboard.php?req=order&status=4");

    }
    if($act == 'update' && $_GET['type'] == 'asc'){
        $id = $_GET['id'];
        $ord_id = $_GET['order_id'];
        $prd_id = $_GET['prd_id'];
        $query = "UPDATE order_details SET quantity = quantity + 1 WHERE order_id = '$ord_id' AND product_id = '$prd_id'";
        $conn->query($query);
       header("Location: ../dashboard.php?req=order-detail&id=$id&stt=1");


    }
    if($act == 'update' && $_GET['type'] == 'desc'){
        $id = $_GET['id'];
        $ord_id = $_GET['order_id'];
        $prd_id = $_GET['prd_id'];

        // $sql = "SELECT * FROM order_details WHERE order_id ='$ord_id'AND product_id ='$prd_id'";
        // $res = $conn->query($sql);
        // $row = mysqli_fetch_array($res);
        // if($row['order_id'])

        $query = "UPDATE order_details SET quantity = quantity - 1 WHERE order_id = '$ord_id' AND product_id = '$prd_id'";
        
        $conn->query($query);
       header("Location: ../dashboard.php?req=order-detail&id=$id&stt=1");

    }
    else{
        echo "oke";
    }

?>
