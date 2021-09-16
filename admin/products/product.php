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
  }
</style>
</head>

<body>
  <!-- <button class="btn btn-primary" id="myBtn">Add Product</button> -->
  <a class="btn btn-primary" href="?req=insert-product">Add product</a>

  <table style="width:100%">
    <tr>
      <th><strong>Name</strong></th>
      <th><strong>Image</strong></th>
      <th><strong>Description </strong></th>
      <th><strong>Price </strong></th>
      <th><strong>Status </strong></th>
      <th><strong> Action </strong></th>
    </tr>
    <?php
    if (isset($_SESSION['waring'])) {
      echo $_SESSION['waring'];
    }
    if (isset($_SESSION['waring_img'])) {
      echo $_SESSION['waring_img'];
    }
    ?>
    <?php
    $query = "SELECT * FROM products";
    $result = $conn->query($query);

    while ($row = mysqli_fetch_array($result)) {
    ?>
      <tr>
        <td><?php echo $row['name']; ?></td>
        <td> <img width="200px" height="200px" src="./products/uploads/<?php echo $row['image']; ?>" /> </td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['price']; ?></td>

        <td>
          <?= $row['status'] == 1 ? "Active" : "Unactive" ?>
        </td>
        <td>
          <a class="btn btn-success" href="?req=update-product&id=<?php echo $row['id'] ?>">Edit</a>
          <a class="btn btn-danger" href="./products/handle.php?act=delete-product&id=<?php echo $row['id'] ?>">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>


  <form method="post" action="./handler.php">

    <div id="myModal" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Add Product</h4>
          </div>
          <div class="modal-body">
            <form>

              <div class="form-group">
                <?php
                $query = "SELECT * FROM category ORDER BY id DESC";
                $result = $conn->query($query);
                ?>
                <label for="message-text" class="control-label">Category:</label>
                <select required class="form-control" name="cateid" id="message-text">
                  <option>Category</option>
                  <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="control-label">Name product:</label>
                <input required type="text" class="form-control" name="nameprd" id="recipient-name">
              </div>

              <div class="form-group">
                <label for="message-text" class="control-label">Images:</label>
                <input type="file" required class="form-control" name="image" id="message-text"></input>
              </div>

              <div class="form-group">
                <label for="message-text" class="control-label">Price:</label>
                <input type="text" required class="form-control" name="price" id="message-text"></input>
              </div>

              <div class="">
                <label for="message-text" class="control-label">Description:</label>
                <textarea required class="form-control" name="desc" id="descc"></textarea>
                <script>
                  CKEDITOR.replace("descc");
                </script>
              </div>

              <div class="form-group">
                <label for="message-text" class="control-label">Operating status:</label>
                <input required type="radio" value="1" name="status" id="message-text" />Active
                <input required type="radio" value="0" name="status" id="message-text" />Unactive
              </div>


            </form>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <input type="submit" name="sbm_add_product" class="btn btn-primary" value="Add">
          </div>
        </div>
      </div>
    </div>
  </form>