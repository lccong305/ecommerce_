<div class="card-detprd">
    <?php
    $id = $_GET['id'];
    $query = "SELECT * FROM products WHERE id = '$id'";
    $result = $conn->query($query);
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <div class="card__prd-detail">
            <div class="prd__detail-img">
                <img src="./admin/products/uploads/<?php echo $row['image'] ?>" />

            </div>
            <div class="prd__detail-content">
                <div class="productName">
                    <span><?php echo $row['name'] ?></span>
                </div>

                <div class="price_rating">
                    <p>$<?php echo $row['price'] ?></p>
                </div>
                <div><?= $row['description'] ?></div>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum corrupti omnis consequuntur, atque veritatis ut voluptatem obcaecati officiis iusto repellat facilis illo tempora, explicabo consequatur, cumque molestias quidem quis sunt!
                </p>
                
                <form >
                    <input type="hidden" name="opt" value="cart" />
                    <input type="hidden" name="act" value="updatedet" />
                    <input type="hidden" name="id" value="<?= $row['id']   ?>" />
                    <input type="text" name="qty" value="1" />
                    <input type="submit" name="" value="Add to cart" />
                </form>
                
                <!-- <span class="add_to_cart_span">Add to cart</span> -->
            </div>
        </div>
    <?php } ?>
</div>