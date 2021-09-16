<div class="box">
    <div class="container">
        <?php
        $query = "SELECT * FROM products";

        if (isset($_GET['keywrd'])) {
            $kw = $_GET['keywrd'];
            $query .= " WHERE name like '%" . $kw . "%' AND status = 1 ";
        }

        if (isset($_GET['id_cate'])) {
            $id_cate = $_GET['id_cate'];
            $query .= " WHERE id_cate = '$id_cate' AND status = 1";
        }

        $result = $conn->query($query);
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <div class="card">
                <div class="imgBx">
                    <img src="./admin/products/uploads/<?php echo $row['image'] ?>" />
                    <ul class="action">
                        <a>
                            <li>
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                <span>Like</span>
                            </li>
                        </a>

                        <a href="?opt=cart&act=add&id=<?= $row['id'] ?>">
                            <li><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span>Add to cart</span>
                            </li>
                        </a>

                        <a href="?opt=detail-prd&id=<?= $row['id'] ?>">
                            <li><i class="fa fa-eye" aria-hidden="true"></i>
                                <span>Views details</span>
                            </li>
                        </a>
                    </ul>
                </div>
                <div class="content">
                    <div class="productName">
                        <h3><?php echo $row['name'] ?></h3>
                    </div>
                    <div class="price_rating">
                        <h2><?php echo $row['price'] ?></h2>
                        <div class="rating">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script>

</script>