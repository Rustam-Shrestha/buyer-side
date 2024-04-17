<?php
include "../components/connection.php";

session_start();
// starting session for obtaining user login credentials
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = "";
}

// logging out user
if (isset($_POST['logout'])) {
    session_destroy();
    header("location: login.php");
}

// adding a product in wishlist
// adding to wishlist from cart we may change mind later
if (isset($_POST['add_wishlist'])) {
    $id = uniq_id();
    // when we hit post requrest with add_wishlist name we also retrive product id from hhidden input automatically
    $product_id = $_POST['product_id'];
    $verify_wishlist = $con->prepare('SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?');
    $verify_wishlist->execute([$user_id, $product_id]);
    $cart_num = $con->prepare('SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?');
    $cart_num->execute([$user_id, $product_id]);
    // removing redundancy aleting that products already exist in wishlist or cart
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
// updating cart
if (isset($_POST['update_cart'])) {

    $cart_id = $_POST['cart_id'];
    // filtering the cart id sanitizing and safely
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRIPPED);
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_NUMBER_INT);
    $update_qty = $con->prepare("UPDATE `cart` SET qty= ? WHERE id= ?");
    $update_qty->execute([$qty, $cart_id]);
    $success_msg[] = "cart quantity is updated";

}

// delete from cart
if (isset($_POST['delete_item'])) {
    // Assuming $con is a valid PDO connection
    // obtaining id with hidden input from cart product lists
    $cart_id = $_POST['cart_id'];

    // filtering the cart id sanitizing and safely
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRIPPED);
    echo $cart_id;
    // Verify if the cart item exists`
    // cuz if it does not exit mysql returns error`
    $verify_delete_item = $con->prepare('SELECT * FROM `cart` WHERE id= ?');
    $verify_delete_item->execute([$cart_id]);

    // Check if the cart item exists
    if ($verify_delete_item->rowCount() > 0) {
        // Delete the cart item
        $delete_cart_id = $con->prepare('DELETE FROM `cart` WHERE id=?');
        $delete_cart_id->execute([$cart_id]);
        $success_msg[] = "Successfully deleted a cart item";
    } else {
        $error_msg[] = "Error deleting cart item ";
    }
}

// emptying a cart
if (isset($_POST['empty_cart'])) {
    $verify_empty_item = $con->prepare("SELECT * FROM `cart` WHERE user_id= ?");
    $verify_empty_item->execute([$user_id]);
    if ($verify_empty_item->rowCount() > 0) {
        $delete_cart_id = $con->prepare('DELETE FROM `cart` WHERE user_id=?');
        $delete_cart_id->execute([$user_id]);
        $success_msg[] = "emptied a cart item";
    } else {
        $error_msg[] = "Error emptying cart item ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        <?php include "../../assets/css/style.css"; ?>
        :root {
            --green: rgba(19, 78, 0, 0.956);
        }

        .carts {
            display: flex;
            justify-content: center;
            align-items: center
        }

        .item {
            padding: 14px;
            margin: 17pX 23px;
            border: 2PX inset var(--green);
            border-radius: 14px;
            ;
        }

        .carts .item .cartimg img {
            max-width: 240px;
            height: auto;
            overflow-y: none;

        }

        .accumulation {
            line-height: 4;
            width: 80%;
            margin: 0 auto;
            text-align: center;
            font-size: 20px;
        }
    </style>
    <title>cart page</title>
</head>

<body>
    <?php include "../components/_header.php"; ?>

    <section class="sign-board">
        <div class="about-content">

            <h1>items on cart</h1>

        </div>
    </section>




    <section class="carts">

      
        <div class="box-container">
            <?php
            $grand_total = 0;
            $select_cart = $con->prepare("SELECT * FROM `cart` WHERE user_id= ?");
            $select_cart->execute([$user_id]);
            if ($select_cart->rowCount() > 0) {
                while ($fetch_carts = $select_cart->fetch(PDO::FETCH_ASSOC)) {

                    $select_products = $con->prepare("SELECT * FROM `products` WHERE id= ?");
                    $select_products->execute([$fetch_carts["product_id"]]);
                    if ($select_products->rowCount() > 0) {
                        $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <form action="" method="POST" class="item">
                            <!-- secretly giving card id to sever -->
                            <input type="hidden" name="cart_id" value="<?= $fetch_carts['id']; ?>">

                            <div class="cartimg">

                                <img src="<?= $fetch_products['image'];?>" alt="lost img" class="img">
                            </div>
                            <div class="desc">
                                <h1><?= $fetch_products['name']; ?></h1>
                                <p><strong>Price:</strong> Rs. <?= $fetch_products['price'] ?>/- </p> 
                                <p><strong>Calculation: </strong> Rs. <?= $fetch_products['price'] ?> &times; <?= $fetch_carts['qty']?> = <?=  $fetch_products['price'] * $fetch_carts['qty']?> </p>
                                
                                <p class="subtotal"><strong>Sub total:</strong> <span>Rs.
                                    <?= $sub_total = ($fetch_carts['qty'] * $fetch_carts['price']) ?>
                                </span> </p>
                            </div>


                            <div class="flex">
                               
                                <input class="btn" type="number" name="qty" required min="1" value=<?= $fetch_carts['qty'] ?> max="99"
                                    maxlength="2" class="qty">
                                <button type="submit" name="update_cart" class="bx bxs-edit fa-edit btn"></button>
                            </div>



                            <button type="submit" name="delete_item" class="btn"
                                onclick="return confirm('are u sure to delete this item');">delete</button>
                            
                        </form>

                        <?php
                        $grand_total += $sub_total;
                    } else {

                        echo "<p class='empty'>products were not found </p>";
                    }
                }
            } else {
                echo "<p class='empty'>no products added yet </p>";
            }

            ?>
        </div>
        

    </section>

    <section class="accumulation">
    <?php
            if ($grand_total > 0) {

                ?>
                <div class="cart-total">
                    <p>total amount payable : <span>
                            <?= $grand_total; ?>
                        </span></p>
                    <div class="summary-buttons">
                        <form action="" method="post">
                            <button type="submit" name="empty_cart" class="btn"
                                onclick="return confirm('are you sure to empty your cart');">clear cart</button>

                                <a href="checkout.php" class="btn">proceed to checkout</a>
                        </form>
                    </div>
                </div>
                <?php

            }
            ?>
       

    </section>
    <?php include "../components/_footer.php"; ?>
    <?php include "../components/alert.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script>
        <?php include "../../view/js/script.js"; ?>
    </script>
</body>

</html>