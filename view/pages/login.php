<?php
session_start();

// Redirect to home page if user is already logged in
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    header('Location: home.php?logout=1');
    exit();
}

// initializing message array
// setting session if set or else set empty item
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = "";
}

include "../components/connection.php";
include "../components/_header.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Check if email and password are not empty
    if (!empty($email) && !empty($pass)) {
        $query = "SELECT * FROM `users` WHERE email= ? AND password= ?";
        $select_user = $con->prepare($query);
        $select_user->execute([$email, $pass]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($select_user->rowCount() > 0) {
            $_SESSION['user_id'] = $row["id"];
            $_SESSION['user_name'] = $row["name"];
            $_SESSION['user_email'] = $row["email"];
            echo "<script>
                    alert('Welcome back Mr./Ms. " . $_SESSION['user_name'] . "');
                    setTimeout(function() {
                        window.location.href = 'home.php';
                    }, 4000); // 4 seconds delay
                  </script>";
        } else {
            $error_msg[] = "Incorrect username and password";
        }
    } else {
        $error_msg[] = "Email and password cannot be empty";
    }
}


// getting user a bad attempt message
if (isset($_GET['attempt']) && $_GET['attempt'] == '1') {
    $warning_msg[] = 'You need to login first';
}
if (isset($_GET['logout']) && $_GET['logout'] == '1') {
    $info_msg[] = 'you logged out of our system';
}
?>

<?php require("../components/alert.php"); ?>

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


    <section class="login">
        <fieldset>
            <legend>Login with buyer account</legend>
            <form action="" method = "post">
                <p>Email address:</p>
                <input type="text" name="email" placeholder="Enter your email" max-length="40" oninput="this.value = this.value.replace(/\s/g, '')">
                <p>Password:</p>
                <input type="password" name="pass" placeholder="Enter your password" max-length="40" oninput="this.value = this.value.replace(/\s/g, '')">
                <br>
                <input class="btn" type="submit" name="submit" value="login">
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