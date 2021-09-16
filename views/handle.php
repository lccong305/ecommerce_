<?php
include("../config/config.php");
session_start();

if (isset($_POST['sbm_login'])) {
    $uname = $_POST['uname'];
    $psw = $_POST['psw'];

    $query1 =  "SELECT * FROM tbl_customer WHERE username = '$uname' AND psw = '$psw' AND status = 0";
    $result1 = $conn->query($query1);

    $query =  "SELECT * FROM tbl_customer WHERE username = '$uname' AND psw = '$psw' AND status = 1";
    $result = $conn->query($query);
    $row = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) > 0) {
        unset($_SESSION['error_login']);
        $_SESSION['user_id'] = $row['id'];
        header("location:../?opt=home");
    } else if (mysqli_num_rows($result1) > 0) {
        $_SESSION['error_login'] = "Your account is locked";
        header("location:../?opt=login");
    } else {
        // $_SESSION['acc'] += 1;
        // echo $_SESSION['acc'];
        // if ($_SESSION['acc'] >= 3) {
        //     $_SESSION['error_login'] = "";
        //     $_SESSION['error_login'] = "TK da bi khoa";
        //     die();
        //     header("location:../?opt=login");
        //     $_SESSION['acc'] == 0;
        //     die();
        // }
        $_SESSION['error_login'] = "Ten dang nhap hoac tai khoan sai, vui long kiem tra lai";
        header("location:../?opt=login");
    }
}

if (isset($_POST['sbm_register'])) {
    $email = $_POST['email'];
    $usn = $_POST['uname'];
    $psw = $_POST['psw'];
    $phone = $_POST['phone'];
    $dc = $_POST['address'];

    $query = "INSERT INTO tbl_customer (email, username, psw, phone, address) VALUES ('$email','$usn','$psw','$phone','$dc')";
    $result = $conn->query($query);
    if (($result)) {
        header("location:../?opt=login");
    }
}

if (isset($_POST['sbm_order'])) {

    $query_customer = "SELECT * FROM tbl_customer WHERE id = '" . $_SESSION['user_id'] . "'";
    $result_customer = $conn->query($query_customer);
    $row_cus = mysqli_fetch_array($result_customer);

    $cus_id = $row_cus['id'] . "</br>";
    $name = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $methodorder = $_POST['methodorder'];

    $query = "INSERT INTO tbl_orders(ordermethod_id, customer_id, receiver_name,receiver_address,phone,email,note) VALUES('$methodorder','$cus_id','$name','$address','$phone','$email','$note')";
    $conn->query($query);

    $query_order_detail = "SELECT id FROM tbl_orders ORDER BY  id DESC LIMIT 1";
    $order_id = mysqli_fetch_array($conn->query($query_order_detail))['id'];

    foreach ($_SESSION['ci'] as $key => $value) {
        $id = $value['id'];
        $price = $value['price'];
        $qty = $value['qty'];
        $query = "INSERT INTO order_details(product_id, order_id,quantity,price) VALUES('$id','$order_id','$qty','$price')";
        $conn->query($query);
    }

    
    unset($_SESSION['ci']);
    header("location:../?opt=home");
}
if (isset($_POST['sbm_comment'])) {

    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error_login'] = 'Vui long dang nhap de binh luan';
        header("location:../?opt=login");
    } else {
        // $id = $_GET['id'];
        $prd_id = $_GET['prd_id'];
        $customer_id = $_GET['user_id'];
        $content = $_POST['content'];
        $conn->query("INSERT INTO tbl_comment (customer_id, product_id, content) VALUES ('$customer_id', '$prd_id' ,'$content')");
        $_SESSION['cmt'] = "Thanks for the comment, your comment will appear soon!";
        header("location:..?opt=detail-prd&id=$prd_id");
    }
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // $cmt_id = "SELECT * FROM tbl_comment WHERE product_id = '$id' ORDER BY  id ASC LIMIT 1";
    // $result = $conn->query($cmt_id);
    // $rw = mysqli_fetch_array($result);
    // $id_last = $rw['id'];
    // echo $id_last;
    // die();

    $data = $conn->query("SELECT cus.username as name, cmt.content as content, cmt.product_id as id FROM tbl_comment as cmt join tbl_customer as cus on cus.id = cmt.customer_id  WHERE cmt.product_id = '$id' AND cmt.status = 1 ORDER BY cmt.id DESC LIMIT 3");

    $output = "";
    while ($row = mysqli_fetch_assoc($data)) {
        $output .= '
            <div class="display-cmt">
                    <span>' . $row['name'] . '</span>
                    <p class="contentcmt">' . $row['content'] . '</p>
                </div>
                ';
    }
    $output .= '
        <tr id="remove_row">
                <td><button id="load_more"   data-id="' . $id . '">Load more</button></td>
            </tr>
        ';

    echo $output;
} else {
    echo "Not find";
}
