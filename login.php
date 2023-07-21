<?php 
    include "./php2/config.php";

    session_start();
    if(!empty($_SESSION["user_id"]))
    {
        session_destroy();
        $connection -> close();
    }

    if(!empty($_POST["username"])) {
        $query = "SELECT * FROM tbl_226_users WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["password"] . "'";

        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);
        
        if(is_array($row))
        {
            $_SESSION["user_id"] = $row['user_id'];
            $_SESSION["username"] = $row['username'];
            $_SESSION["user_type"] = $row['user_type'];
            $_SESSION["user_img"] = $row['user_img'];
            $_SESSION["login"] = true;   
            header('Location: ./index.php');
        }
        else
        {
            $message = "Invalid username or password";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="./js/nav.js" defer></script>
</head>

<body>
    <section class="scub-container content-background sign-form-container">
        <div class="sign-form-header">
            <img src="./imgs/logo.png" alt="scubaround logo" class="logo">
            <h1>Login</h1>
        </div>
        <div class="sign-form">
            <form action="#" method="post">
                <div class="sign-inputs">
                    <input type="text" id="username" name="username" placeholder="Username">

                    <input type="password" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-button-group">
                    <a href="./signup.php">Sign Up</a>
                    <button type="submit" class="button">Login</button>
                </div>
                <div class="sign-error-msg">
                    <?php
                        if(isset($message))
                        {
                            echo $message;
                        }
                    ?>
                </div>
            </form>
        </div>
    </section>
</body>

</html>