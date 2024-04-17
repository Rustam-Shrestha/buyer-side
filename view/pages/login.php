<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        <?php include "../../assets/css/style.css"; ?>
        <?php include "../../assets/css/login-style.css"; ?>
    </style>
    <title>Login page</title>
</head>

<body>
    <?php include "../components/_header.php"; ?>


    <section class="login">
        <fieldset>
            <legend>Login with buyer account</legend>
            <form action="" method = "post">
                <p>Email address:</p>
                <input type="text" name="email" placeholder="Enter your email" max-length="40" oninput="this.value = this.value.replace(/\s/g, '')">
                <p>Password:</p>
                <input type="password" name="password" placeholder="Enter your password" max-length="40" oninput="this.value = this.value.replace(/\s/g, '')">
                <br>
                <input type="submit" class="btn">
                <p>Don't hve an account with us? <a href="signup.php">signup</a></p>
            </form>
        </section>
    </fieldset>

    <?php include "../components/_footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script>
        <?php include "../../view/js/script.js"; ?>

    </script>
</body>

</html>