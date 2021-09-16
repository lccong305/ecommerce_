<?php
$id = $_GET['id'];
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

?>
<div class="comment">
<h1> Comment</h1>
   
    <form method="post" action="./views/handle.php?user_id=<?= $user_id ?>&prd_id=<?= $id ?>">
        <textarea style="resize: none;" cols="80" rows="10" id="comment" name="content" placeholder="">


        </textarea>
        <input class="sbm_cmt" value="Comment" type="submit" name="sbm_comment" />
    </form>
    <?php
    $res = $conn->query("SELECT cus.username as name, cmt.content as content FROM tbl_comment as cmt join tbl_customer as cus on cus.id = cmt.customer_id   WHERE cmt.product_id = '$id'  AND cmt.status = 1 order by cmt.id desc LIMIT 3 ");

    ?>
    <div id="div_cmt">
        <?php
        while ($row = mysqli_fetch_array($res)) {
        ?>
            <div class="display-cmt">
                <span><?= $row['name'] ?></span>
                <p class="contentcmt"><?= $row['content'] ?></p>
            </div>
            <!-- <?php $idx = $row['id']; ?> -->
        <?php } ?>
    </div>
    <table>
        <tr id="remove_row">
            <td><button id="load_more" data-id="<?= $id ?>">Load more</button></td>
        </tr>
    </table>
</div>
