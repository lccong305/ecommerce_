<?php

$id =  (isset($_GET['id'])) ?  $_GET['id'] : "";
echo $id;
$query  = "SELECT a.username, a.phone as 'customer_phone', a.address as 'customer_address', b.*,c.method_order FROM tbl_customer a join tbl_orders b on a.id = b.customer_id Join tbl_methodorder c on b.ordermethod_id = c.id WHERE b.id =" . $id;
$result = $conn->query($query);
$rowOrder = mysqli_fetch_array($result);

$queryprd = "SELECT products.name, products.image, order_details.quantity, order_details.price FROM products join order_details on products.id = order_details.product_id  WHERE order_details.order_id = '$id'";

$queryprdd = "SELECT p.name as name, p.image as image, p.price as price, od.* FROM tbl_orders as o join order_details as od on o.id = od.order_id join products as p on od.product_id = p.id  WHERE od.order_id = '$id'";

$resultprd = $conn->query($queryprd);
$resultprdd = $conn->query($queryprdd);
// $resultprd = $conn->query($queryprd);
// $rowprd1 = mysqli_fetch_array($resultprd);

?>


<h1 class="title_orderDet">DETAILS ORDER
  <span>Order id[<?= $rowOrder['id'] ?>]</span>
</h1>
<h3>Information order </h3>
<table class="table table-bordered">
  <tbody>
    <tr>
      <th scope="col">Order date</th>
      <td><?= $rowOrder['order_date'] ?></td>
    </tr>
    <tr>
      <th scope="col">Customer name</th>
      <td><?= $rowOrder['username'] ?></td>
    </tr>
    <tr>
      <th scope="col">Phone number</th>
      <td><?= $rowOrder['customer_phone'] ?></td>
    </tr>
    <tr>
      <th scope="col">Address</th>
      <td><?= $rowOrder['customer_address'] ?></td>
    </tr>
  </tbody>
</table>
<?php $stt = isset($_GET['stt']) ? $_GET['stt'] : '' ?>

<h3>Information receiver name</h3>
<table class="table table-bordered">
  <tbody>
    <tr>
      <th scope="col">Receiver name</th>
      <td><?= $rowOrder['receiver_name'] ?></td>
    </tr>
    <tr>
      <th scope="col">Phone number</th>
      <td><?= $rowOrder['phone'] ?></td>
    </tr>
    <tr>
      <th scope="col">Receiver address</th>
      <td><?= $rowOrder['receiver_address'] ?></td>
    </tr>
    <tr>
      <th scope="col">Note</th>
      <td><?= $rowOrder['note'] ?></td>
    </tr>

    <tr>
      <th scope="col">Method order</th>
      <td><?= $rowOrder['method_order'] ?></td>
    </tr>
  </tbody>
</table>

<h3>Details order product</h3>
<table class="table table-bordered">
  <tbody>
    <tr>
      <th scope="col">Name product</th>
      <th scope="col">Image</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
    </tr>
    <?php
    $subtotal = 0;
    while ($row = mysqli_fetch_array($resultprdd)) {
      $subtotal += ($row['price'] * $row['quantity']);
    ?>
      <tr>
        <td><?= $row['name'] ?></td>
        <td width="15%"><img width="150px" height="" src="products/uploads/<?= $row['image'] ?>" /></td>
        <td>

          <form method="post">

            <p style="display:<?= $stt == 3 ? 'none' : '' ?>">
              <input type="button" value="+" onclick="location='./orders/handler.php?id=<?= $_GET['id'] ?>&act=update&type=asc&prd_id=<?= $row['product_id'] ?>&order_id=<?= $row['order_id'] ?>'" />
            </p>

            <span><?= $row['quantity'] ?></span>
            <p style="display:<?= $stt == 3 ? 'none' : '' ?>">
              <input <?= $row['quantity'] == 0 ? 'disabled':''?> type="button" value="-" onclick="location='./orders/handler.php?id=<?= $_GET['id'] ?>&act=update&type=desc&prd_id=<?= $row['product_id'] ?>&order_id=<?= $row['order_id'] ?>'" />
            </p>
          </form>
        </td>
        <td>$<?= $row['price'] ?></td>
      </tr>
    <?php } ?>
  </tbody>
  <th>Subtotal</th>
  <td style="text-align:center" colspan="3">$<?= $subtotal ?></td>
</table>

<h3>Handler order </h3>
<table class="table table-bordered">
  <form method="POST" action="./orders/handler.php?id=<?= $rowOrder['id'] ?>">
    <div class="form form-group">
      <p style="display:<?= $stt || $stt == 3 ? 'none' : '' ?>">
        <input value="1" <?= $rowOrder['status'] == 1 ? 'checked' : '' ?> type="radio" name="status" /><span>Order Processing</span>
      </p>
    </div>

    <div class="form form-group">
    </div>
    <div class="form form-group">
      <p style="display:<?= $stt == 3 ? 'none' : '' ?>">
        <input <?= $rowOrder['status'] == 2 ? 'checked' : '' ?> type="radio" value="2" name="status" /><span>Order in Progress</span>
      </p>
    </div>
    <div class="form form-group">
      <p>
        <input value="3" <?= $rowOrder['status'] == 3 ? 'checked' : '' ?> type="radio" name="status" />Order processed
      </p>
    </div>
    <div class="form form-group">
      <p style="display:<?= $stt == 3 ? 'none' : '' ?>">
        <input value="4" type="radio" <?= $rowOrder['status'] == 4 ? 'checked' : '' ?> name="status" />Order Cancel
      </p>
    </div>
    <input type="submit" class='btn btn-danger' value="Save" name="sbm_save_order" />
  </form>
</table>