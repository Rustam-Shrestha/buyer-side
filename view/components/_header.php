<header class="header">
    <a href="home.php">
        <img style="width:40px; height:40px" src="../../assets/imgs/logo.jpg" alt="linker" class="logo">
    </a>
    <div class="nav-container">
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="view_products.php">products</a>
            <a href="orders.php">orders</a>
            <a href="about.php">about us</a>
            <a href="contact.php">contact us</a>
        </nav>
        <div class="wildcard-icons">
            <?php
            // fetching total no of itemsin cart with spwecific email
            $count_wishlist_items = $con->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_items = $count_wishlist_items->rowCount();

            // fetcching total no of items in wishlist
            $count_cart_items = $con->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
            ?>

            <!-- user ko icon vayeko wala  -->
            <!-- open navigator -->
            <i class="bx bx-user" id="user-btn" alt="user icon"></i>
            <a href="cart.php"><i class="bx bx-cart-download" alt="cart icon"><sup class="blob"><?=$total_cart_items;?></sup></i></a>
            <a href="wishlist.php"><i class="bx bx-heart" alt="wushlist icon"></i><sup class="blob"><?=$total_wishlist_items;?></sup></a>
        </div>
    <div class="icons">
        <button id="toggler">slide</button>
    </div>
    </div>
</header>

<div class="modal" id="modal">
    <p id="terminator" >&times;</p>
    <a href="login.php" class="btn">login</a>
    <a href="signup.php" class="btn">signup</a>
    <button type="submit" name="logout" class="logout-btn">log out</button>
</div>

<script>
    var opener = document.getElementById("user-btn");
    var terminator = document.getElementById("terminator");
    var modal = document.getElementById("modal");
    opener.addEventListener("click", ()=>{
        modal.style.display="block";
        modal.style.transition="1.1s";
    })
    terminator.addEventListener("click",()=>{
        modal.style.display="none";
        modal.style.transition="1.1s";
    })

</script>