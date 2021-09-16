<?php

$query = "SELECT * FROM tbl_orders WHERE status=" . $_GET['status'];
$result = $conn->query($query);
?>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <!-- <th scope="col">Receiver name</th> -->
      <!-- <th scope="col">Receiver address</th> -->
      <!-- <th scope="col">Phone number</th> -->
      <th scope="col">Order date</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    $stt = $_GET['status'];

    ?>
    <?php while ($row = mysqli_fetch_array($result)) { ?>
      <tr>
        <th scope="row"><?php echo $i++; ?></th>
        <!-- <td><?= $row['receiver_name'] ?></td> -->
        <!-- <td><?= $row['receiver_address'] ?></td> -->
        <!-- <td><?= $row['phone'] ?></td> -->
        <td><?= $row['order_date'] ?></td>
        <td>
          <?php
          if ($row['status'] == 1) {
            echo "Order processing";
          } else if ($row['status'] == 2) {
            echo "Order in Progress";
          } else if ($row['status'] == 3) {
            echo "Order processed";
          } else {
            echo "Order cancel";
          }
          ?>
        </td>
        <td>
          <a href="?req=order-detail&id=<?php echo $row['id']?>&stt=<?= $row['status'] ?>">View</a>
          <a style="display: <?= $row['status'] == 4 ? "block" : "none" ?>" onclick="return confirm('Are you sure?')" href="./orders/handler.php?act=delete-order&id=<?php echo $row['id'] ?>">Delete</a>
        </td>

      </tr>
    <?php }  ?>


  </tbody>
</table>

