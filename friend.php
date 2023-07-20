<?php
    include "./php2/config.php";
    session_start(); // start session

    // check for login
    if (!isset($_SESSION["username"])) {
        header("location: ./login.php");
        exit; // prevent further execution
    }
    if(isset($_GET))
    {
        $userID = $_GET['user_id'];
        $queryUser = "SELECT username, email, age FROM tbl_226_users WHERE user_id = $userID";
        $resultUser = mysqli_query($connection, $queryUser);
        $userInfo = mysqli_fetch_assoc($resultUser);
    }

    $queryDives = "SELECT d.dive_name, dd.dive_date, r.route_type, dd.dive_max_depth 
               FROM tbl_226_dives d
               INNER JOIN tbl_226_routes r ON d.route_id = r.route_id
               INNER JOIN tbl_226_dive_details dd ON d.dive_id = dd.dive_id
               WHERE d.user_id = $userID AND d.is_public = 1
               ORDER BY dd.dive_date DESC
               LIMIT 3";
    $resultDives = mysqli_query($connection, $queryDives);

    $queryPosts = "SELECT post_description, post_date FROM tbl_226_posts 
               WHERE user_id = $userID 
               ORDER BY post_date DESC 
               LIMIT 3";
    $resultPosts = mysqli_query($connection, $queryPosts);

    $queryCommonFriends = "SELECT DISTINCT u.username, f.is_online
                        FROM tbl_226_friendship f
                        INNER JOIN tbl_226_users u ON f.user2_id = u.user_id
                        WHERE f.user1_id = $userID
                        UNION
                        SELECT DISTINCT u.username, f.is_online
                        FROM tbl_226_friendship f
                        INNER JOIN tbl_226_users u ON f.user1_id = u.user_id
                        WHERE f.user2_id = $userID";
$resultCommonFriends = mysqli_query($connection, $queryCommonFriends);
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
    <script src="js/index.js" defer></script>
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
                        <a href="#">
                            <div class="nav-item">
                                <img src="./imgs/chat_FILL1_wght400_GRAD0_opsz48.png" alt="">
                                Messages
                            </div>
                        </a>
                        <a href="#">
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
                <a href="./profile.php"><a href="./profile.php"><img src="./imgs/profile-icon.png" alt="profile logo" class="profile-logo"></a></a>
            </div>
        </div>
    </header>

    <div class="scub-container content-background">
        <div class="main-header profile-margin">User Information</div>
            <div class="profile-block">
                <p>Username: <?php echo $userInfo['username']; ?></p>
                <p>Email: <?php echo $userInfo['email']; ?></p>
                <p>Age: <?php echo $userInfo['age']; ?></p>
            </div>
        <div class="main-header">Recent Posts</div>
            <div class="profile-block">
                <?php while ($rowPost = mysqli_fetch_assoc($resultPosts)) { ?>
                    <p>Post Date: <?php echo $rowPost['post_date']; ?></p>
                    <p>Post Description: <?php echo $rowPost['post_description']; ?></p>
                    <hr>
                <?php } ?>
            </div>
        <div class="main-header">Recent Dives</div>
            <div class="profile-block">
                    <?php while ($rowDive = mysqli_fetch_assoc($resultDives)) { ?>
                        <p>Dive Name: <?php echo $rowDive['dive_name']; ?></p>
                        <p>Dive Date: <?php echo $rowDive['dive_date']; ?></p>
                        <p>Route Type: <?php echo $rowDive['route_type']; ?></p>
                        <p>Max Depth: <?php echo $rowDive['dive_max_depth']; ?></p>
                        <hr>
                    <?php } ?>
            </div>
    <div class="main-header">Mutual Friends</div>
        <div class="profile-block">
            <?php while ($rowFriend = mysqli_fetch_assoc($resultCommonFriends)) { ?>
                <?php
                // Determine the color based on the friend's online status
                $statusColor = ($rowFriend['is_online'] == 1) ? 'green' : 'red';
                ?>
                <p>
                    <span style="color: <?php echo $statusColor; ?>;"><?php echo $rowFriend['username']; ?></span>
                </p>
            <?php  ?>
    </div>
        <div class="button">
        <button onclick="showConfirmation()">Remove Friend</button>
    </div>
    <button class="button" onclick="showConfirmation()">Remove Friend</button>

<!-- Lightbox for confirmation -->
<div id="confirmationBox" class="lightbox" style="display: none;">
    <div class="confirmation-content">
        <h3>Are you sure you want to remove this friend?</h3>
        <button onclick="removeFriendConfirmed()">Yes</button>
        <button onclick="hideConfirmation()">Cancel</button>
    </div>
</div>

<script>
   
    function showConfirmation() {
        const confirmationBox = document.getElementById("confirmationBox");
        confirmationBox.style.display = "block";
    }

    
    function hideConfirmation() {
        const confirmationBox = document.getElementById("confirmationBox");
        confirmationBox.style.display = "none";
    }

    function removeFriendConfirmed() {
        const confirmationBox = document.getElementById("confirmationBox");

        const friendUserID = <?php echo $userID; ?>;

     
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {

                // console.log(xhr.responseText);
                window.location.href = "./friendslist.php";
            }
        };
        xhr.open("POST", "remove_friend.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("friend_user_id=" + friendUserID);
        hideConfirmation();
    }
</script>
</div>
</body>
</html>