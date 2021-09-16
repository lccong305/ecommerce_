<div class="box">
    <div class="container">
        <?php
        $query = "SELECT * FROM products WHERE status = 1 ORDER by id desc";
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
                        <div class="saleoff">
                            <span>Bình Dương</span>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script>

</script>