<?php
    include "./php2/config.php";
    $message = "";
    // if a session already exists, destroy it
    session_start();
    if(!empty($_SESSION["user_id"]))
        session_destroy();
    
    if(isset($_REQUEST['username'])) 
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $age = $_POST["age"];
        $email = $_POST["email"];
        $userType = "user"; // Setting user to default user type
        $userImg = ""; // Setting an empty default user image path

        $query = "INSERT INTO tbl_226_users (username, password, age, email, user_type, user_img) VALUES ('" . $username . "', '" . $password . "', " . $age . ", '" . $email . "', '" . $userType . "', '" . $userImg . "')";
        $result = mysqli_query($connection, $query);

        if($result)
        {
            $message = "Sign up successful, redirecting to login";
            sleep(2); // delay page redirection for 3 seconds
            header("Location: ./login.php");
            exit();
        }
        else
            $message = "Database error";
    }

    
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
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
                    <input type="text" id="username" name="username" required placeholder="Username">
                    <input type="password" id="password" name="password" required placeholder="Password">
                    <input type="number" id="age" name="age" placeholder="Age">
                    <input type="email" id="email" name="email" required placeholder="Email">
                </div>

                <div class="form-button-group">
                    <a href="./login.html">Login</a>
                    <button type="submit" class="button">Sign Up</button>
                </div>
                <div class="sign-error-msg">
                    <?php
                        echo $message;
                    ?>
                </div>
            </form>
        </div>
    </section>
</body>

</html>