<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$query = "SELECT * FROM category WHERE id = '$id'";
$result = $conn->query($query);
$row = mysqli_fetch_array($result);
?>

<div class="content_update_cate">
    <form method="post" action="./handler.php?id=<?= $id ?>">
        <input type="hidden" id="update_category_id" name="update_category_id" />
        <div class="form-group">
            <label for="recipient-name" class="control-label">Name:</label>
            <input required type="text" class="form-control" value="<?php echo $row['name'] ?>" name="namecate" id="namecate">
        </div>

        <div class="form-group">
            <label for="message-text" class="control-label">Description:</label>
            <textarea required class="form-control" name="desc" id="descCate"><?php echo $row['description'] ?></textarea>
        </div>

        <div class="form-group">
            Active <input type="radio" name="status" value="1" <?= ($row['status'] == 1) ? 'checked' : '' ?> />
            Unactive <input type="radio" name="status" value="0" <?= ($row['status'] == 0) ? 'checked' : '' ?> />
        </div>
        <input class="btn btn-primary" type="submit" name="sbm_update_cate" value="Update" />
    </form>

</div>