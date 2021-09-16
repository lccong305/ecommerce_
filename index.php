<?php
include("./config/config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoping cart</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="asset/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="./asset/css/bootstrap.min.css"> -->

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body>
    <?php
    include('views/layouts/header.php');
    ?>

    <?php
    if (isset($_GET['opt'])) {
        switch ($_GET['opt']) {
            case "home":
                include('./views/layouts/sidebarleft.php');
                include("./views/home.php");
                break;
            case "detail-prd":
                include("./views/detailPrd.php");
                include("./views/layouts/comment.php");
                break;
            case "cart":
                include("./views/cart.php");
                break;
            case "order":
                if (isset($_SESSION['user_id'])) {
                    include("./views/order.php");
                } else {
                    header("Location:?opt=login");
                }
                break;
            case "register":
                include("./views/register.php");
                break;
            case "logout":

                unset($_SESSION['user_id']);
                unset($_SESSION['cmt']);
                unset($_SESSION['error_login']);
                header("Location:?opt=login");
                break;
            case "login":
                include("./views/login.php");
                break;
            case "showprd":
                include('./views/layouts/sidebarleft.php');
                include("./views/showprd.php");
                break;
            default:
                include('./views/layouts/sidebarleft.php');
                include("home.php");
        }
    } else {
        include("views/showprd.php");
    }
    ?>


    <script>
        $(document).ready(function() {
            $(document).on('click', '#load_more', function(evnt) {
                event.preventDefault();
                var id = $('#load_more').data('id');
                // var user_id = $('#load_more').data('user_id');
                // alert(user_id);

                $.ajax({
                    url: "./views/handle.php",
                    type: "post",
                    data: {id: id},
                    success: function(data) {
                        $('#remove_row').remove();
                        $('#div_cmt').append(data);

                    }
                })
            })
        })
    </script>
</body>

</html>