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

  h1 {
    margin-top: 0px;
  }
</style>
</head>

<body>

  <table cellspacing="0" cellpadding="" style="width:100%">
    <tr>
      <th><strong>STT</strong></th>
      <th><strong>Name</strong></th>
      <th><strong>Description </strong></th>
      <th><strong>Status </strong></th>
      <th><strong> Action </strong></th>
    </tr>
    <?php
    $query = "SELECT * FROM category ORDER BY id DESC";
    $result = $conn->query($query);
    while ($row = mysqli_fetch_array($result)) {
    ?>
      <tr>
        <td>
          <?php echo $row['id'] ?>
        </td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['description']; ?></td>

        <td>
          <?= ($row['status'] == 1) ? 'Active' : 'Unactive'; ?>
        </td>

        <td>
          <a class="btn btn-success" href="?req=update-cate&id=<?php echo $row['id'] ?>">Edit</a>
          <!-- <button type="button" class="btn btn-success editbtn">Edit</button> -->
          <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="./handler.php?act=delete-cate&id=<?php echo $row['id'] ?>">Delete</a>
        </td>

      </tr>
    <?php } ?>
  </table>

  <button class="btn btn-primary" id="myBtn">Add category</button>
  <form method="post" action="./handler.php">

    <div id="myModal" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Add Category</h4>
          </div>
          <div class="modal-body">
            <?php

            ?>
            <form>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Name:</label>
                <input required type="text" class="form-control" name="namecate" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label">Description:</label>
                <textarea required class="form-control" name="desc" id="message-text"></textarea>
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
            <input type="submit" name="sbm_add_category" class="btn btn-primary" value="Add">
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- ==================================================================================== -->
  <!-- edit modal -->

  <form method="post" action="./handler.php">
    <div id="editModal" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Edit Category</h4>
          </div>
          <div class="modal-body">
            <?php
            $query = "SELECT * FROM category";
            $result = $conn->query($query);
            ($row = mysqli_fetch_array($result));
            ?>

            <form>
              <input type="hidden" id="update_category_id" name="update_category_id" />
              <div class="form-group">
                <label for="recipient-name" class="control-label">Name:</label>
                <input required type="text" class="form-control" name="namecate" id="namecate">
              </div>

              <div class="form-group">
                <label for="message-text" class="control-label">Description:</label>
                <textarea required class="form-control" name="desc" id="descCate"></textarea>
              </div>
              <div class="form-group">
                <!-- <label for="message-text" class="control-label">Active:</label> -->
                <!-- <input type="checked" value="1" required  name="active"  id="active"> -->

                <!-- <textarea required class="form-control" name="desc" id="descCate"></textarea> -->
              </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" name="closes" data-dismiss="modal">Close</button>
            <input type="submit" name="sbm_update_category" class="btn btn-primary" value="UPdate">
          </div>
        </div>
      </div>
    </div>
  </form>