<?php
    include "./php/config.php";
    session_start(); // start session

    // check for login
    if (!isset($_SESSION["username"])) {
        header("location: ./login.php");
        exit; // prevent further execution
    }
    
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Object</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap');
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="js/nav.js" defer></script>

</head>

<body>
    <header class="header">
        <div class="scub-container scub-row-space-bet">
            <div class="nav-and-logo scub-row">
                <div class="hamburger-button">
                    <span onclick="openNav()" class="hamburger"></span>
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a href="./index.php">
                            <div class="nav-item">
                                <img src="./imgs/home_FILL1_wght400_GRAD0_opsz48.png" alt="">
                                Home
                            </div>
                        </a>
                        <a href="./list.php">
                            <div class="nav-item">
                                <img src="./imgs/history_FILL1_wght400_GRAD0_opsz48.png" alt="">
                                Dive History
                            </div>
                        </a>
                        <a href="./newdive.php">
                            <div class="nav-item">
                                <img src="./imgs/scuba-dive-icon.png" alt="">
                                Plan New Dive
                            </div>
                        </a>
                        <div class="nav-item-divider"></div>
                        <a href="./friendslist.php">
                            <div class="nav-item">
                                <img src="./imgs/group_FILL1_wght400_GRAD0_opsz48.png" alt="">
                                Friends
                            </div>
                        </a>
                        <a href="./newpost.php">
                            <div class="nav-item">
                                <img src="./imgs/chat_FILL1_wght400_GRAD0_opsz48.png" alt="">
                                New Post
                            </div>
                        </a>
                        <a href="./community.php">
                            <div class="nav-item">
                                <img src="./imgs/groups_FILL1_wght400_GRAD0_opsz48.png" alt="">
                                Community
                            </div>
                        </a>
                        <div class="nav-item-divider"></div>
                        <a href="#">
                            <div class="nav-item">
                                <img src="./imgs/settings_FILL1_wght400_GRAD0_opsz48.png" alt="">
                                Settings
                            </div>
                        </a>
                        <a href="#">
                            <div class="nav-item">
                                <img src="./imgs/help_FILL1_wght400_GRAD0_opsz48.png" alt="">
                                Help
                            </div>
                        </a>
                        <a href="./php/logout.php">
                            <div class="nav-item">
                                <img src="./imgs/logout_FILL1_wght400_GRAD0_opsz48.png" alt="">
                                Logout
                            </div>
                        </a>
                    </div>
                </div>
                <a href="./index.php"><img src="./imgs/logo.png" alt="scubaround logo" class="logo"></a>
            </div>
            <div class="search-and-profile">
            <a href="./profile.php"><img src="<?php echo $_SESSION["user_img"]; ?>" alt="profile logo" class="profile-logo"></a>
            </div>
        </div>
    </header>

    <div class="scub-container content-background profile-section">
        <div class="main-header">
            <h2>User Settings</h2>
        </div>
            <?php
            $userID = $_SESSION['user_id'];
            $query = "SELECT * FROM tbl_226_users WHERE user_id = $userID";
            $result = mysqli_query($connection, $query);
            
            $row = mysqli_fetch_assoc($result);
            ?>
            <form method="post">
                <input class='form-control' type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                <div class="profile-block">
                <label for="username">Username:</label>
                <input class='form-control' type="text" name="username" value="<?php echo $row['username']; ?>" required>
                </div>
                <div class="profile-block">
                <label for="password">Password:</label>
                <input class='form-control' type="password" name="password" value="<?php echo $row['password']; ?>" required>
                </div>
                <div class="profile-block">
                <label for="age">Age:</label>
                <input class='form-control' type="text" name="age" value="<?php echo $row['age']; ?>" required>
                </div>
                <div class="profile-block">
                <label for="email">E-mail:</label>
                <input class='form-control' type="email" name="email" value="<?php echo $row['email']; ?>" required>
                </div>
                <div class="profile-block">
                <div class="save-profile-btn">
                    <button class="button " type="submit">Save Changes</button>
                </div>
                </div>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $age = $_POST['age'];
                $email = $_POST['email'];

                $query2 = "UPDATE tbl_226_users SET username='" . $username . "', password='" . $password . "', age='" . $age . "', email='" . $email . "' WHERE user_id='" . $userID . "'";
                $result = mysqli_query($connection, $query2);
                if ($result) {
                    $message = "Record updated successfully.";
                } else {
                    $message = "Error updating record: " . $connection->error;
                }
            }
            ?>
    </div>       
</body>
</html>