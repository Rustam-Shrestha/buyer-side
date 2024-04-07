<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        <?php include "../../assets/css/style.css"; ?>
        :root {
  --green: rgb(1, 171, 171);
}
        .carts{
            display:flex;
            justify-content: center;
            align-items: center
        }
        .item{
            padding:14px;
            margin: 17pX 23px;
            border: 2PX inset var(--green);
            border-radius: 14px;;
        }
        .carts .item .cartimg img{
            max-width:240px;
            height:auto;
            overflow-y: none;
            
        }
        .accumulation{
            line-height: 4;
            width:80%;
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
        
        <div class="item">
            <div class="cartimg">
                <img src="../../assets/imgs/img1.jpg" alt="cart product">
            </div>
            <div class="desc">
                <!-- name price and subtotla -->
                <h1>this is carted fruit</h1>
                <p><strong>Price:</strong> 240</p>
                <p><strong>Subttotal: </strong>480</p>
            </div>
            <input type="number"> <br /><br />
            <div class="icons">
                
                <a href="" class="btn">edit</a>
                <a href="" class="btn">delete</a>
            </div>
        </div>
        <div class="item">
            <div class="cartimg">
                <img src="../../assets/imgs/img1.jpg" alt="cart product">
            </div>
            <div class="desc">
                <!-- name price and subtotla -->
                <h1>this is carted fruit</h1>
                <p><strong>Price:</strong> 240</p>
                <p><strong>Subttotal: </strong>480</p>
            </div>
            <input type="number"> <br /><br />
            <div class="icons">
                
                <a href="" class="btn">edit</a>
                <a href="" class="btn">delete</a>
            </div>
        </div>
        <div class="item">
            <div class="cartimg">
                <img src="../../assets/imgs/img1.jpg" alt="cart product">
            </div>
            <div class="desc">
                <!-- name price and subtotla -->
                <h1>this is carted fruit</h1>
                <p><strong>Price:</strong> 240</p>
                <p><strong>Subttotal: </strong>480</p>
            </div>
            <input type="number"> <br /><br />
            <div class="icons">
                
                <a href="" class="btn">edit</a>
                <a href="" class="btn">delete</a>
            </div>
        </div>
     
    </section>

    <section class="accumulation">
        <strong>Total Amount Payable: </strong><span>699</span>
        <div class="buttons">

            <a href="" class="btn">clear cart</a>
            <a href="" class="btn">proceed to checkout from cart</a>
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