<?php
include "../components/connection.php";

// session checkpoint
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = "";
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("location: login.php");
}

// product page needs to have ability to store data from products table to carts and wishlists

// adding a product in wishlist
if (isset($_POST['add_to_wishlist'])) {
    $id = uniqid();
    $product_id = $_POST['product_id'];
    $verify_wishlist = $con->prepare('SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?');
    $verify_wishlist->execute([$user_id, $product_id]);
    $cart_num = $con->prepare('SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?');
    $cart_num->execute([$user_id, $product_id]);
    if ($verify_wishlist->rowCount() > 0) {
        $warning_msg[] = 'product already exists in your wishlist';
    } else if ($cart_num->rowCount() > 0) {
        $warning_msg[] = 'product already exists in your cart';
    } else {
        $select_price = $con->prepare("SELECT * FROM `products` WHERE id= ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);
        $insert_wishlist = $con->prepare("INSERT INTO `wishlist` (id, user_id, product_id, price) VALUES(?,?,?,?)");
        $insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);
        $success_msg[] = 'successfully added to wishlist';
    }
}

// adding a product in cart
if (isset($_POST['add_to_cart'])) {
    $id = uniqid();
    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_NUMBER_INT);
    
    $verify_cart = $con->prepare('SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?');
    $verify_cart->execute([$user_id, $product_id]);
    
    $max_cart_items = $con->prepare("SELECT * FROM `cart` WHERE user_id=? ");
    $max_cart_items->execute([$user_id]);
    if ($verify_cart->rowCount() > 0) {
        $warning_msg[] = 'product already in your cart';
    } else if ($max_cart_items->rowCount() > 20) {
        $warning_msg[] = 'cart is already full';
    } else {
        $select_price = $con->prepare("SELECT * FROM `products` WHERE id= ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);
        $insert_cart = $con->prepare("INSERT INTO `cart` (id, user_id, product_id, price, qty) VALUES(?,?,?,?,?)");
        $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
        $success_msg[] = 'successfully added to cart';
    }
}

// if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == "") {
//     header('Location: login.php?attempt=1');
//     exit();
// }

?>
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
    <?php require ("../components/alert.php"); ?>

    <!-- filter container -->
    <div class="container">

        <div class="category-box">All</div>
        <div class="category-box">Berries</div>
        <div class="category-box">Drupes</div>
        <div class="category-box">Pomes</div>
        <div class="category-box">Citrus Fruits</div>
        <div class="category-box">Melons</div>
        <div class="category-box">Dried Fruits</div>
        <div class="category-box">Tropical Fruits</div>
        <div class="category-box">Others</div>
    </div>
    <section class="products">
        <div class="item">
            <?php
            $select_products = $con->prepare("SELECT * FROM `products`");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <form action="" method="post" class="box">

                        <img src="<?= $fetch_products['image']; ?>" class='img' />
                        <?php
                        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == "") {
                            echo "<div style='background-color:rgba(19, 78, 0, 0.956); color:white'>login for more features </div>";
                        } else {
                            echo '<div class="buttons">
    <!-- adding to cart after getting clicked in add -->
    <button type="submit" name="add_to_cart"> <i class="bx bx-cart"></i></button>
    <!-- adding to wishlist after clicking -->
    <button type="submit" name="add_to_wishlist" value="' . $fetch_products["id"] . '"> <i class="bx bx-heart"></i></button>

    <a href="view_page.php?pid=' . $fetch_products["id"] . '" class="bx bxs-show"></a>
</div>';

                        }
                        ?>

                        <h3 class="name">
                            <?= $fetch_products['name']; ?>
                        </h3>
                        <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">

                        <div class="flex">
                            <p class="price">price:
                                Rs.
                                <?= $fetch_products['price']; ?>/-
                                <input class="btn quantity" type="number" name="qty" required value="1" min="1" max="99" maxlength="2"
                                    data-product-id="<?= $fetch_products['id']; ?>">
                            </p>
                        </div>
                        <br>
                        <br>
                        <!-- <a name="buy" type="submit" href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">buy now</a> -->
                        <a href="#" class="btn checkout" data-product-id="<?= $fetch_products['id']; ?>">buy now</a>

                    </form>
                    <?php
                }
            } else {
                echo '<p class="empty">no products added yet! </p>';
            }
            ?>
        </div>
    </section>

    <!-- <form action="" method="post" class="box">
        <div class="item">
            <img src="../../assets/imgs/img2.jpg" alt="">
            <div class="item-title">
                <h1>this is fruit</h1>
            </div>
            <p class="price">price: Rs. 20</p>
            <div class="icons">
           cart wishlist and view button here
                <a href="">cart</a>
                <a href="">wishlist</a>
                <a href="">view</a>
            </div>
            <input type="number" name="qty" required value="1" min="1" max="99" maxlength="2" class="qty">
                            
            <a href="" class="buy btn">buy now</a>
        </div>
    </form>-->

    </section>
    <?php include "../components/_footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script>
        <?php include "../../view/js/script.js"; ?>
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.checkout').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const productId = this.getAttribute('data-product-id');
                    const quantityInput = document.querySelector(`.quantity[data-product-id="${productId}"]`);
                    if (quantityInput) {
                        const quantity = quantityInput.value;
                        window.location.href = `checkout.php?get_id=${productId}&qty=${quantity}`;
                    } else {
                        console.error('Quantity input not found for product ID:', productId);
                    }
                });
            });
        });
    </script>
</body>
</html>
