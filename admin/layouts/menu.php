<?php
$processing = mysqli_num_rows($conn->query("SELECT * FROM tbl_orders WHERE status = 1 "));
$inProgress = mysqli_num_rows($conn->query("SELECT * FROM tbl_orders WHERE status = 2 "));
$processed = mysqli_num_rows($conn->query("SELECT * FROM tbl_orders WHERE status = 3 "));
$orderCancel = mysqli_num_rows($conn->query("SELECT * FROM tbl_orders WHERE status = 4 "));
?>



<div class="wrapper-menu">
  <div class="caption">Category</div>

  <ul class="  menu-list">
    <li class="menu-items"><a href="?req=home">Them danh muc</a></li>
    <li class="menu-items"><a href="?req=product">Them san pham</a></li>
    <li class="menu-items"><a href="?req=comment">Comments</a></li>

    <ul class="menu-list dropdown">
      <span class="span">Order</span>
      <div class="dropdown-content">
        <span><a href="?req=order&status=1">Order Processing(<?= $processing ?>)</a></span>
        <span><a href="?req=order&status=2">Order in Progress(<?= $inProgress ?>)</a></span>
        <span><a href="?req=order&status=3">Order Processed(<?= $processed ?>)</a></span>
        <span><a href="?req=order&status=4">Order Cancel(<?= $orderCancel ?>)</a></span>
      </div>
    </ul>
  </ul>
</div>