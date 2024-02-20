<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include "components/style.css"; ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </style>
    <title>Home page</title>
</head>

<body>
    <?php include "components/_header.php"; ?>

    <div class="wallpaper">
        <div class="carousel-container">
            <button class="carousel-btn-prev carousel-btn" onclick="prevSlide()">
                &#8249;
            </button>
            <div class="carousel">
                <img src="assets/img1.jpg" alt="image 1">
                <img src="assets/img2.jpg" alt="image 2">
                <img src="assets/img3.jpg" alt="image 3">
                <img src="assets/img4.jpg" alt="image 4">
            </div>
            <button class="carousel-btn carousel-btn-next" onclick="nextSlide()">
                &#8250;
            </button>
        </div>
    </div>
    <script>
        <?php include "script.js"; ?>
        
    </script>
</body>

</html>