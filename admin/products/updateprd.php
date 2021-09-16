

<div class="container-insert-prd">
    <div class="modal-body">
        <?php
            $id = $_GET['id'];
           
            $result = $conn->query("SELECT * FROM products WHERE id = '$id'");
            $row = mysqli_fetch_array($result);
        ?>
        <form method="POST" action="./products/handle.php?id=<?php echo $row['id']; ?>" enctype="multipart/form-data" >
            <div class="form-group">
                <?php
                $query1 = "SELECT * FROM category ";
                $result1= $conn->query($query1);
                ?>
                <label for="message-text" class="control-label">Category:</label>
                <select required class="form-control" name="cateid" id="message-text">
                    <option>Category</option>
                    <?php while ($row1 = mysqli_fetch_array($result1)) { ?>
                        <option value="<?php echo $row1['id'] ?>" <?= $row['id_cate'] == $row1['id'] ?'selected':''?>><?php echo $row1['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
                    
            <div class="form-group">
                <label for="recipient-name" class="control-label">Name product:</label>
                <input required type="text" value="<?php echo $row['name'] ?>"class="form-control" name="nameprd" id="recipient-name">
            </div>

            <div class="form-group">
                <label for="message-text" class="control-label">Images:</label>
                <input type="file"  class="form-control" name="image" id="message-text" />
                <img height="220px" width="210" src="./products/uploads/<?php echo $row['image'] ?>" />
            </div>

            <div class="form-group">
                <label for="message-text" class="control-label">Price:</label>
                <input type="text" required class="form-control" value="<?php echo $row['price'] ?>"name="price" id="message-text"></input>
            </div>

            <div class="">
                <label for="message-text" class="control-label">Description:</label>
                <textarea required class="form-control" name="desc" id="descc"><?php echo $row['description'] ?></textarea>
                <script>
                    CKEDITOR.replace("descc");
                </script>
            </div>

            <div class="form-group">
                <label for="message-text" class="control-label">Operating status:</label>
                <input required <?= $row['status'] == 1?'checked':'' ?> type="radio" value="1" name="status" id="message-text" />Active
                <input required <?= $row['status'] == 0?'checked':'' ?> type="radio" value="0" name="status" id="message-text" />Unactive
            </div>
            <input class="btn btn-primary" type="submit" value="UPdate" name="sbm_update_prd" />
        </form>
    </div>
</div>