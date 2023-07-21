<?php
    include "./php/config.php";
    session_start(); // start session

    // do check
    if (!isset($_SESSION["username"])) {
        header("location: ./login.php");
        exit; // prevent further execution, should there be more code that follows
    }     
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap');
    </style>
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
    <div class="home-content-area">
        <div class="left-side-home">
            <div class="content-background">
                <a href="./newdive.php">
                    <div class="main-header scub-row-space-bet">
                        <h2>Today's Conditions</h2>
                        <h2>Location - GPS</h2>
                    </div>
                    <div class="conditions-area scub-row-space-aro">
                        <div>
                            <img src="./imgs/device_thermostat_icon.png" alt="thermostat">
                            <span>17° C</span>
                        </div>
                        <div>
                            <img src="./imgs/waves_icon.png" alt="thermostat">
                            <span>Calm</span>
                        </div>
                        <div>
                            <img src="./imgs/air_icon.png" alt="thermostat">
                            <span>7 KM/h</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="content-background home-content-limit">
                <div class="main-header">
                    <a href="#">
                        <h2>Shared Posts</h2>
                    </a>
                </div>
                <div class="post-area">
                    <div class="post-header">
                        <h3>Karen Smith</h3>
                        <span>4 hours ago</span>
                    </div>
                    <div class="post-content">
                        <p class="post-desc">Saw some awesome fish during today’s dive!!</p>
                        <div class="post-img">
                            <img src="./imgs/example_post_img.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="post-area-divider"></div>
                <div class="post-area">
                    <div class="post-header">
                        <h3>William Beans</h3>
                        <span>8 hours ago</span>
                    </div>
                    <div class="post-content">
                        <p class="post-desc">I embarked on a daring dive into the deep abyss, exploring a remote
                            underwater trench. I encountered bioluminescent creatures rarely seen by human eyes and
                            witnessed the otherworldly wonders of the abyssal zone.
                    </div>
                    <div class="post-img"></div>
                </div>
                <div class="post-area-divider"></div>
                <div class="post-area">
                    <div class="post-header">
                        <h3>Idan Omedli</h3>
                        <span>9 hours ago</span>
                    </div>
                    <div class="post-content">
                        <p class="post-desc">WOW! Crazy dive today where I nearly DROWNED!
                    </div>
                    <div class="post-img"></div>
                </div>
                <div class="post-area-divider"></div>
                <div class="post-area">
                    <div class="post-header">
                        <h3>Oport Mernoy</h3>
                        <span>10 hours ago</span>
                    </div>
                    <div class="post-content">
                        <p class="post-desc">Explore the wreckage of an old galleon that once carried precious cargo.
                            Uncover scattered chests and ancient coins, providing a glimpse into the rich history of
                            seafaring adventures.
                    </div>
                    <div class="post-img"></div>
                </div>
            </div>
        </div>
        <div class="right-side-home">
            <div class="content-background home-content-limit">
                <a href="./list.php">
                    <div class="main-header">
                        <h2>Recent Dives</h2>
                    </div>
                </a>
                    <?php
                        $query = "SELECT dives.dive_id, dives.dive_name, dives.is_public, details.dive_date, details.dive_duration, dives.dive_description
                        FROM tbl_226_dives AS dives
                        INNER JOIN tbl_226_dive_details AS details ON dives.dive_id = details.dive_id
                        WHERE dives.user_id =  '" . $_SESSION["user_id"] . "'";
                  
                    $result = mysqli_query($connection, $query);
                    if(!mysqli_num_rows($result))
                    {
                        echo "<div class='recent-dive-area' style='justify-content:center'>No dives found</div>";
                    }
                    else {
                        
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $diveId = $row['dive_id'];
                            $diveName = $row['dive_name'];
                            $diveDate = $row['dive_date'];
                            $diveStatus = $row['is_public'];
                            $diveDesc = $row['dive_description'];
                            $diveDur = $row['dive_duration'];

                            echo "<div class = 'recent-dive-area'>";
                                echo '<a href="./dive.php?dive_id=' . $diveId . '">';
                                    echo "<div class = recent-dive-header";
                                        echo "<h3>" . $diveName . "</h3>";
                                        echo "</a>";
                                        echo "<span>" . $diveDate . "</span>";
                                    echo "</div>";
                                echo "<div class='recent-dive-content'>";
                                    echo "<p>" . ($diveDesc ? $diveDesc : "-") ."</p>";
                                echo "</div>";
                            echo"</div>";  
                        } 
                                      
                    }
                    ?>
</body>

</html>