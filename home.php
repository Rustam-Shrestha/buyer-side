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

    <section class="main">
        <div class="caro-container">
            <div class="caro-slide">
                <img src="assets/img1.jpg" alt="img 1">
                <div class="caro-item">
                    <h3>heading</h3>
                    <a href="" class="btn"></a>
                </div>
            </div>
            <div class="caro-slide">
                <img src="assets/img2.jpg" alt="img 2">
                <div class="caro-item">
                    <h3>heading</h3>
                    <a href="" class="btn"></a>
                </div>
            </div>
            <div class="caro-slide">
                <img src="assets/img3.jpg" alt="img 3">
                <div class="caro-item">
                    <h3>heading</h3>
                    <a href="" class="btn"></a>
                </div>
            </div>
            <div class="caro-slide">
                <img src="assets/img4.jpg" alt="img 4">
                <div class="caro-item">
                    <h3>heading</h3>
                    <a href="" class="btn"></a>
                </div>
            </div>

            <div class="caro-steer">
        <button id="prev">&#8249;</button>
        <button id="next">&#8250;</button>
    </div>
        </div>
    </section>
    <script>
        <?php include "script.js"; ?>
    </script>
</body>

</html>