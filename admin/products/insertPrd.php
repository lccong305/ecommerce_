<div class="container-insert-prd">
    <div class="modal-body">
        <form method="POST" action="./products/handle.php" enctype="multipart/form-data" >
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
            <input class="btn btn-primary" type="submit" value="Save" name="sbm_add_prd" />
        </form>
    </div>
</div>