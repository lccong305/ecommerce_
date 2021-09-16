<?php
    $query_cate = "SELECT * FROM category ";
    $result = $conn->query($query_cate);
?>

<div class="category">
    <div class="list-cate">
        <?php while($row = mysqli_fetch_array($result)){ ?>
        <a href="?opt=showprd&id_cate=<?=$row['id']?>"><span> <?php echo $row['name'] ?> </span> </a>
        <?php } ?>
    </div>
</div>