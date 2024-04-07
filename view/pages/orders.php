<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        <?php include "../../assets/css/style.css"; ?>
        <?php include "../../assets/css/orders-style.css"; ?>
    </style>
    <title>products page</title>
</head>

<body>
    <?php include "../components/_header.php"; ?>

    <section class="sign-board">
        <h1>Pending Orders</h1>
        <strong><a style="color:inherit" href="home.php">HOME</a>&nbsp; &nbsp;/ORDERS</strong>
    </section>

    <section class="orderlist">
        <div class="order">
            <h1>Cantapula</h1>
            <img src="../../assets/imgs/img3.jpg" alt="ordered item">
            <p><Strong>Receiver name:</Strong> Rustam Shrestha</p>
            <p><Strong>Summary:</Strong> 750 x 2 = 1500</p>
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