<?php
session_start();
include('../config/config.php');


$id = isset($_GET['id']) ? $_GET['id'] : '';
$req = isset($_GET['req']) ? $_GET['req'] : '';
if ($req == 'undisplay-cmt') {

    $check_stt = "SELECT * FROM tbl_comment WHERE id = '$id'";
    $res_check = $conn->query($check_stt);
    $row = mysqli_fetch_array($res_check);
    if ($row['status'] == 1) {
        $conn->query("UPDATE tbl_comment SET status = 0 WHERE id = '$id'");
        header("Location:./dashboard.php?req=comment");
    } else {
        $conn->query("UPDATE tbl_comment SET status = 1 WHERE id = '$id'");
        header("Location:./dashboard.php?req=comment");
    }
}else if($req == 'delete-cmt'){
    $conn->query("DELETE FROM tbl_comment WHERE id = '$id'");
    header("Location:./dashboard.php?req=comment");

}
