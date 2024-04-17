<?php
include "../components/_header.php";
include "../components/connection.php";
session_start();

// initializing message array
// setting session if set or else set empty item
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = "";
}

// registering user
if (isset($_POST['submit'])) {
    // setting unique id while getting data from form
    $id = uniqid();
    $name = $_POST['username'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = $_POST['cpass'];
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    // checking if email already exists
    $query = "SELECT * FROM `users` WHERE email= ?";
    $select_user = $con->prepare($query);
    $select_user->execute([$email]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
    // not inserting redundant data
    if ($select_user->rowCount() > 0) {
        $message[] = "Email already exists in the database";
    } else {
        if ($pass != $cpass) {
            $message[] = "Passwords do not match";
        } else {
            $query = "INSERT INTO `users` (id, name, email, password) VALUES(?,?,?,?)";
            $insert_user = $con->prepare($query);
            $insert_user->execute([$id, $name, $email, $pass]);

            // after inserting redirect to home.php
            header("location: home.php");
            $sqlQuery = "SELECT * FROM `users` where email= ? AND password = ?";
            $select_user = $con->prepare($sqlQuery);
            $select_user->execute([$email, $pass]);
            $row = $select_user->fetch(PDO::FETCH_ASSOC);
            // log in the user by getting the details like id password
            if ($select_user->rowCount() > 0) {
                // setting session by giving fetched data
                $_SESSION['user_id'] = $row["id"];
                $_SESSION['user_name'] = $row["name"];
                $_SESSION['user_email'] = $row["email"];
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        <?php include "../../assets/css/style.css"; ?>
        <?php include "../../assets/css/signup-style.css"; ?>
    </style>
</head>

<body>
    <section class="signup">
        <fieldset>
            <legend>Signup for new account</legend>
            <form action="" method="post">
                <p>username:</p>
                <input type="text" name="username" placeholder="Enter your name" max-length="40">
                <p>Email address:</p>
                <input type="text" name="email" placeholder="Enter your email" max-length="40"
                    oninput="this.value = this.value.replace(/\s/g, '')">
                <p>Password:</p>
                <input type="password" name="pass" placeholder="Enter your password" max-length="40"
                    oninput="this.value = this.value.replace(/\s/g, '')">
                <p>Confirm Password:</p>
                <input type="password" name="cpass" placeholder="Confirm your password" max-length="40"
                    oninput="this.value = this.value.replace(/\s/g, '')">
                <br>
                <input type="submit" class="btn" name="submit">
                <p>already have an account? <a href="login.php">login</a></p>
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
