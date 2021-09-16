<?php
$query = "SELECT  cus.username as name, cmt.content as content, cmt.status as stt, cmt.id as id, cmt.product_id as prd_id FROM tbl_comment as cmt join tbl_customer as cus on cmt.customer_id = cus.id order by cmt.id desc";
$res = $conn->query($query);
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product id</th>
            <th scope="col">Name</th>
            <th scope="col">Content</th>
            <!-- <th scope="col">Active1</th> -->
            <th scope="col">Active</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        while ($row = mysqli_fetch_array($res)) { ?>
            <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><?= $row['prd_id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['content'] ?></td>
                <!-- <td><?= $row['stt'] == 1 ? "Active" : "Unactive" ?>  </td> -->
                <td>
                    <?php
                        if($row['stt'] == 1) {
                         ?><a href="?req=undisplay-cmt&id=<?= $row['id'] ?>" ><i class="fas fa-eye"></i></a> <?php
                        }else{
                         ?><a href="?req=undisplay-cmt&id=<?= $row['id'] ?>" ><i class="fas fa-eye-slash"></i></a> <?php
                        }
                    ?>
                </td>
                


                <td>
                    <!-- <a href="?req=undisplay-cmt&id=<?= $row['id'] ?>">Un-AC</a>_-+_ -->
                    <a href="?req=delete-cmt&id=<?= $row['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>
<?php
    if(isset($_SESSION['f'])){
        echo $_SESSION['f'];
    }
?>