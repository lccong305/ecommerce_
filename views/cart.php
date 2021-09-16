<?php
$act = isset($_GET['act']) ? $_GET['act'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$qty = isset($_GET['qty']) ? $_GET['qty'] : 1;

// var_dump($_GET);
// die();
if ($qty <= 0) {
    $qty = 0;
}

if ($act == "add") {
    $query_ = "SELECT * FROM products WHERE id = '$id'";
    $res = $conn->query($query_);
    $row = mysqli_fetch_array($res);
    $ai = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'image' => $row['image'],
        'price' => $row['price'],
        'qty' => $qty,
    );
}
if($act == 'updatedet'){
    $_SESSION['ci'][$id]['qty'] = $qty;
}

if ($act == 'add') {
    if (isset($_SESSION['ci'][$id])) {
        $_SESSION['ci'][$id]['qty'] += $qty;
        // header("location:?opt=cart");
    } else {
        $_SESSION['ci'][$id] = $ai;
        // header("location:?opt=cart");
    }
    header("location:?opt=cart");
}

if ($act == 'del') {
    unset($_SESSION['ci'][$id]);
    header("location:?opt=cart");
}
// if($act == 'update') {
//     $_SESSION['ci'][$id]['qty'] = $qty;
//     header("location:?opt=cart");
// }

if ($act == 'update') {
    if (isset($_GET['type'])) {
        if ($_SESSION['ci'][$id]['qty'] >= 0.9) {
            if ($_GET['type'] == 't') {
                $_SESSION['ci'][$id]['qty'] += 1;
            } else {
                $_SESSION['ci'][$id]['qty'] -= 1;
            }
        }
        if ($_SESSION['ci'][$id]['qty'] == 0) {
            $_SESSION['ci'][$id]['qty'] += 1;
        }
    }
    header("location:?opt=cart");
}
// echo "<pre>";
// var_dump($_SESSION['ci']);
// echo "</pre>";
// header("Location: ./views/detcart.php");
// die();
?>
<section class="">
    <table style="width:100%" border="1px" cellspacing="0">
        <tr>
            <th width="10%">Name</th>
            <th width="200px" height="">Image</th>
            <th width="20%">Price</th>
            <th width="10%">Quantity</th>
            <th>Total</th>
            <th width="20%">Ation</th>
        </tr>
        <?php
        if (empty($_SESSION['ci'])) {
            $_SESSION['annouce_cart'] = "hien khong co san pham!";
        }
        ?>
        <?php
        if (isset($_SESSION['ci'])) {
            foreach ($_SESSION['ci'] as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['name'] ?></td>
                    <td> <img width="100%" height="200" src="./admin/products/uploads/<?php echo $value['image'] ?>" /></td>
                    <td><?php echo $value['price'] ?></td>
                    <td>
                    <!-- <form >
                        <input type="hidden" name="opt" value="cart" />
                        <input type="hidden" name="id" value="<?php echo $value['id'] ?>" />
                        <input type="hidden" name="act" value="update" />
                        <input type="number" name="qty" value="<?php echo $value['qty'] ?>" />
                        <input type="submit" name="" value="update" />
                    </form> -->

                        <input type="button" value="-" onclick="location='?opt=cart&id=<?= $value['id'] ?>&act=update&type=g';" />
                        <input class="qtycart" type="text" name="qty" min="1" value="<?php echo $value['qty'] ?>" />
                        <input type="button" value="+" onclick="location='?opt=cart&id=<?= $value['id'] ?>&act=update&type=t';" />
                    <td><?php echo $value['qty'] * $value['price'] ?> </td>
                    </td>
                    <td>
                        <a href="?opt=cart&act=del&id=<?php echo $value['id'] ?>">Xoa</a>
                    </td>
                <?php }
                ?>

                </tr>
                <tr>
                    <th>
                        subtotal
                    </th>
                    <?php
                    $stotal = 0;
                    foreach ($_SESSION['ci'] as $key => $value) {
                        $stotal += ($value['qty'] * $value['price']);
                    }
                    ?>
                    <td><?php echo $stotal; ?>
                    </td>
                    <td colspan="4"><?php
                                    if (isset($_SESSION['annouce_cart'])) {
                                        echo $_SESSION['annouce_cart'];
                                    }
                                    if (isset($_SESSION['ci'])) {
                                        unset($_SESSION['annouce_cart']);
                                    }
                                    ?></td>
                </tr>
            <?php
        } else {
            echo "";
        }
            ?>

    </table>
    <a href="?opt=order" >Order</a>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
            align-items: center;
        }

        input.qtycart {
            width: 30px;
            max-width: 50px;
        }
    </style>