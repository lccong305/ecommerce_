<?php
include('../config/config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../asset/reset.css?<?php echo time() ?>">
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/admin.css?<?php echo time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../asset/ckeditor/ckeditor.js"></script>

</head>

<body>
    <?php include('./layouts/header.php') ?>
    <?php
    if (isset($_GET['req'])) {
        switch ($_GET['req']) {
            case "home":
    ?>
                <div class="container">
                    <div class="menu">
                        <?php
                        include("./layouts/menu.php");
                        ?>
                    </div>
                    <div class="content">
                        <?php
                        include("./category/category.php");
                        ?>
                    </div>
                </div>

            <?php
                break;
            case "comment":
    ?>
                <div class="container">
                    <div class="menu">
                        <?php
                        include("./layouts/menu.php");
                        ?>
                    </div>
                    <div class="content">
                        <?php
                        include("./comments/comments.php");
                        ?>
                    </div>
                </div>

            <?php
                break;
            case "product":
            ?>
                <div class="container">
                    <div class="menu">
                        <?php
                        include("./layouts/menu.php");
                        ?>
                    </div>
                    <div class="content">
                        <?php

                        include("./products/product.php");
                        ?>
                    </div>
                </div>

            <?php
                break;
            case "logout":
                unset($_SESSION['admin_id']);
                unset($_SESSION['login_error']);
                header("Location:./index.php");
                break;
            case "update-cate":
                include('./category/update_cate.php');
                break;
            case "undisplay-cmt":
                include('./comments/handler.php');
                break;
            case "delete-cmt":
                include('./comments/handler.php');
                break;
            case "order":
            ?>
                <div class="container">
                    <div class="menu">
                        <?php
                        include("./layouts/menu.php");
                        ?>
                    </div>
                    <div class="content">
                        <?php

                        include("./orders/showorders.php");
                        ?>
                    </div>
                </div>

            <?php
                break;
            case "order-detail":
            ?>
                <div class="container">
                    <div class="menu">
                        <?php
                        include("./layouts/menu.php");
                        ?>
                    </div>
                    <div class="content">
                        <?php

                        include("./orders/orderDetails.php");
                        ?>
                    </div>
                </div>

        <?php
                break;
            case "update-product":
                include('./products/updateprd.php');
                break;
            case "insert-product":
                unset($_SESSION['waring']);
                unset($_SESSION['waring_img']);
                include('./products/insertPrd.php');
                break;
        }
    } else {
        ?>
        <div class="container">
            <div class="menu">
                <?php
                include("./layouts/menu.php");
                ?>
            </div>
            <div class="content">
                <?php
                include("./category/category.php");
                ?>
            </div>
        </div>
    <?php } ?>





    <style>

    </style>
</body>
<script type="text/javascript" src="../asset/js/bootstrap.min.js"> </script>
<script src="../asset/js/jquery-3.6.0.min.js"> </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
   
    $('.editbtn').on('click', function() {
        var modal = document.getElementById("editModal");
        modal.style.display = "block";
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log(data);
        $('#update_category_id').val(data[0]);
        $('#namecate').val(data[1]);
        $('#descCate').val(data[2]);
        $('#active').val(data[3]);
        // $('#aactive').val(data[3]); 
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    });

    var modal = document.getElementById("myModal");
    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<script>

</script>

</html>