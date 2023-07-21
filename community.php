<?php
    include "./php/config.php";
    session_start(); // start session

    // check for login
    if (!isset($_SESSION["username"])) {
        header("location: ./login.php");
        exit; // prevent further execution
    }

    $userID = $_SESSION['user_id'];
    
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commnunity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="./js/nav.js" defer></script>
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
                                Setting
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
    <div class="scub-container content-background">
        <?php
            $friends_query = "SELECT tbl_226_users.username,tbl_226_friendship.user1_id, tbl_226_friendship.user2_id, tbl_226_friendship.is_online, tbl_226_users.user_img 
            FROM tbl_226_friendship
            INNER JOIN tbl_226_users ON (tbl_226_friendship.user2_id = tbl_226_users.user_id OR tbl_226_friendship.user1_id = tbl_226_users.user_id)
            WHERE tbl_226_friendship.user1_id = $userID OR tbl_226_friendship.user2_id = $userID";
            $friends_result = mysqli_query($connection, $friends_query);
            while($friends_row = mysqli_fetch_assoc($friends_result))
            {
                $targetUserId = ($friends_row['user1_id'] == $userID) ? $friends_row['user2_id'] : $friends_row['user1_id'];
                $posts_query = "SELECT * FROM tbl_226_posts WHERE user_id=$targetUserId ORDER BY post_date DESC";
                $posts_result = mysqli_query($connection, $posts_query);
                while($posts_row = mysqli_fetch_assoc($posts_result))
                {   
                    echo "<div class='main-header'>" . $friends_row["username"] . "</div>";
                    echo "<p class='post-desc'>" . $posts_row["post_description"] . "</p>";
                }
            }
            ?>
    </div>
</body>
</html>