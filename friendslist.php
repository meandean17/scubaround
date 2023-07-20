<?php
    include "./php2/config.php";
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
    <script src="js/index.js" defer></script>

</head>

<body>

    <script>

    </script>
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
                <a href="./profile.php"><img src="./imgs/profile-icon.png" alt="profile logo" class="profile-logo"></a>
            </div>
        </div>
    </header>

    <div class="scub-container content-background" >
    <div class="main-header">
                <h2>Friends</h2>
    </div>
    <ul id="diveList" class="dive-list">
        <?php
            $userID = $_SESSION['user_id'];
            $query = "SELECT tbl_226_users.username,tbl_226_friendship.user1_id, tbl_226_friendship.user2_id, tbl_226_friendship.is_online
                    FROM tbl_226_friendship
                    INNER JOIN tbl_226_users ON tbl_226_friendship.user2_id = tbl_226_users.user_id
                    WHERE tbl_226_friendship.user1_id = $userID OR tbl_226_friendship.user2_id = $userID";
            $result = mysqli_query($connection, $query);
            
            if(!mysqli_num_rows($result))
            {
                echo "<div class='dive-list-item' style='justify-content:center'>No friends found</div>";
            }
            else
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $targetUserId = ($row['user1_id'] == $userID) ? $row['user2_id'] : $row['user1_id'];
                    $friendName = $row['username'];
                    $is_online = $row['is_online'];
                    echo "<a href='./friend.php?user_id=" . $targetUserId . "' class='dive-list-item'>";
                    echo "<div class='friend-name'>" . $friendName . "</div>";

                    $query2 = "SELECT tbl_226_dive_details.dive_date 
                                FROM tbl_226_dive_details
                                INNER JOIN tbl_226_dives USING(dive_id)
                                INNER JOIN tbl_226_users ON tbl_226_dives.user_id = tbl_226_users.user_id
                                WHERE tbl_226_users.user_id = $targetUserId and tbl_226_dives.is_public = true  ORDER BY tbl_226_dive_details.dive_date DESC LIMIT 1";

                    $result2 = mysqli_query($connection, $query2);
                    
                    // $last_dive = mysqli_fetch_assoc($result2);
                    $diveDate = "-";
                    if($last_dive = mysqli_fetch_array($result2))
                        $diveDate = $last_dive['dive_date'];
                    
                    echo "<div class='friend-last-dive'>Last Dive: ". $diveDate . "</div>";    
                    echo "<div class='friend-status " . ($is_online ? 'online' : 'offline') . "'>" . ($is_online ? 'Online' : 'Offline') . "</div>";                    
                    echo "</a>";
                }   
            }                 
        ?>
    </ul>
    </div>
</body>
</html>