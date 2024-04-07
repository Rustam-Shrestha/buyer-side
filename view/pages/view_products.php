<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        <?php include "../../assets/css/style.css"; ?>
        <?php include "../../assets/css/products-style.css"; ?>
    </style>
    <title>products page</title>
</head>

<body>
    <?php include "../components/_header.php"; ?>

    <section class="sign-board">
        <h1>All products</h1>
        <strong><a style="color:inherit" href="home.php">HOME</a>&nbsp; &nbsp;/PRODUCTS</strong>
    </section>


    <section class="products">
        <div class="item">
            <img src="../../assets/imgs/img2.jpg" alt="">
            <div class="item-title">
                <h1>this is fruit</h1>
            </div>
            <div class="icons">
                <!-- cart wishlist and view button here -->
                <a href="">cart</a>
                <a href="">wishlist</a>
                <a href="">view</a>
            </div>
            <a href="" class="buy btn">buy now</a>
        </div>
        <div class="item">
            <img src="../../assets/imgs/img2.jpg" alt="">
            <div class="item-title">
                <h1>this is fruit</h1>
            </div>
            <div class="icons">
                <!-- cart wishlist and view button here -->
                <a href="">cart</a>
                <a href="">wishlist</a>
                <a href="">view</a>
            </div>
            <a href="" class="buy btn">buy now</a>
        </div>
        <div class="item">
            <img src="../../assets/imgs/img2.jpg" alt="">
            <div class="item-title">
                <h1>this is fruit</h1>
            </div>
            <div class="icons">
                <!-- cart wishlist and view button here -->
                <a href="">cart</a>
                <a href="">wishlist</a>
                <a href="">view</a>
            </div>
            <a href="" class="buy btn">buy now</a>
        </div>
    </section>
    <?php include "../components/_footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script>
        <?php include "../../view/js/script.js"; ?>

    </script>
</body>

</html>