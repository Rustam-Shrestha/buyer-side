<!DOCTYPE html>
<html lang="en">
<?php 
    include "../components/connection.php";
        session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        $user_id = "";
    }
    if (isset($_POST['logout'])) {
        session_destroy();
        header("location: login.php?logout=1");
        $message[] = "logged out of system";
    }
    
    ?>
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        <?php include "../../assets/css/style.css"; ?>
    </style>
    <title>Home page</title>
</head>

<body>
   <?php
    include "../components/_header.php"; 
    ?>
    <?php require("../components/alert.php"); ?>
    <div class="wallpaper">
        <div class="carousel-container">
            <button class="carousel-btn-prev carousel-btn" onclick="prevSlide()">
                &#8249;
            </button>
            <div class="carousel">
                <img src="../../assets/imgs/img1.jpg" alt="image 1">
                <img src="../../assets/imgs/img2.jpg" alt="image 2">
                <img src="../../assets/imgs/img3.jpg" alt="image 3">
                <img src="../../assets/imgs/img4.jpg" alt="image 4">
                <img src="../../assets/imgs/img1.jpg" alt="image 1">
                <img src="../../assets/imgs/img2.jpg" alt="image 2">
                <img src="../../assets/imgs/img3.jpg" alt="image 3">
                <img src="../../assets/imgs/img4.jpg" alt="image 4">
            </div>
            <button class="carousel-btn carousel-btn-next" onclick="nextSlide()">
                &#8250;
            </button>
        </div>
    </div>
    <!-- all top 4 items are shown in this section -->

    <section class="top-items">
    <a href="#">
        <div class="top-item">
            <img src="../../assets/imgs/img1.jpg" alt="top item">
            <h1>green leafy vegetables</h1>
            <p>green leafy vegetables are best for fitness</p>
        </div>
    </a>
    <a href="#">
        <div class="top-item">
            <img src="../../assets/imgs/img1.jpg" alt="top item">
            <h1>green leafy vegetables</h1>
            <p>green leafy vegetables are best for fitness</p>
        </div>
    </a>
    <a href="#">
        <div class="top-item">
            <img src="../../assets/imgs/img1.jpg" alt="top item">
            <h1>green leafy vegetables</h1>
            <p>green leafy vegetables are best for fitness</p>
        </div>
    </a>
    <a href="#">
        <div class="top-item">
            <img src="../../assets/imgs/img1.jpg" alt="top item">
            <h1>green leafy vegetables</h1>
            <p>green leafy vegetables are best for fitness</p>
        </div>
    </a>
    <!-- Repeat the above structure for other .top-item divs -->
</section>

    <!-- sponsored banner and discount items are shown here -->
    <section class="sponsored">
        <div class="banner-img">
            <img src="../../assets/imgs/img1.jpg" alt="banner image">
        </div>
        <div class="banner-desc">
            <h1>Bumper offer</h1>
            <p>Inshane discount of <strong>4%</strong> off</p>
            <a href="" class="btn">shop now</a>
        </div>
    </section>

    <h1 style=" background: linear-gradient(45deg, red, yellow, red);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  color: transparent; text-align:center;">Trending Bulks</h1>
    <section class="trendings">

    <a href="#">
        <div class="trending-item">
            <img src="../../assets/imgs/img1.jpg" alt="top item">
            <h1>green leafy vegetables</h1>
            <p>green leafy vegetables are best for fitness</p>
        </div>
    </a>
    <!-- Repeat the above structure for other .trending-item divs -->
    <a href="#">
        <div class="trending-item">
            <img src="../../assets/imgs/img1.jpg" alt="top item">
            <h1>green leafy vegetables</h1>
            <p>green leafy vegetables are best for fitness</p>
        </div>
    </a>
    <!-- Repeat the above structure for other .trending-item divs -->
    <a href="#">
        <div class="trending-item">
            <img src="../../assets/imgs/img1.jpg" alt="top item">
            <h1>green leafy vegetables</h1>
            <p>green leafy vegetables are best for fitness</p>
        </div>
    </a>
    <!-- Repeat the above structure for other .trending-item divs -->
    <a href="#">
        <div class="trending-item">
            <img src="../../assets/imgs/img1.jpg" alt="top item">
            <h1>green leafy vegetables</h1>
            <p>green leafy vegetables are best for fitness</p>
        </div>
    </a>
    <!-- Repeat the above structure for other .trending-item divs -->
</section>

    </section>
    <?php include "../components/_footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script>
        <?php include "../../view/js/script.js"; ?>

    </script>
</body>

</html>