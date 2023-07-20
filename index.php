<?php
    include "./php2/config.php";
    session_start(); // start session

    // do check
    if (!isset($_SESSION["username"])) {
        header("location: .login.php");
        exit; // prevent further execution, should there be more code that follows
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap');
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="./js/index.js" defer></script>
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
                <img src="./imgs/profile-icon.png" alt="profile logo" class="profile-logo">
            </div>
        </div>
    </header>
    <div class="home-content-area">
        <div class="left-side-home">
            <div class="scub-container content-background">
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
            <div class="scub-container content-background home-content-limit">
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
            <div class="scub-container content-background home-content-limit">
                <a href="./list.php">
                    <div class="main-header">
                        <h2>Recent Dives</h2>
                    </div>
                </a>
                <a href="./dive.php">
                    <div class="recent-dive-area">
                        <div class="recent-dive-header">
                            <h3>Mystic Caverns</h3>
                            <span>18/08/23</span>
                        </div>
                        <div class="recent-dive-content">
                            <p>I ventured into a mysterious underwater cave system, my
                                flashlight
                                illuminating the dark passages. The cave walls were adorned with breathtaking stalactite
                                formations, and the water sparkled with bioluminescent creatures. I was amazed by the
                                graceful
                                shark that swam past me, seemingly at home in this otherworldly realm.</p>
                        </div>
                    </div>
                </a>
                <div class="post-area-divider"></div>
                <div class="recent-dive-area">
                    <div class="recent-dive-header">
                        <h3>Whale Symphony</h3>
                        <span>02/06/23</span>
                    </div>
                    <div class="recent-dive-content">
                        <p>I was filled with excitement as I dived alongside humpback
                            whales.
                            The magnificent creatures communicated through powerful songs, creating a symphony that
                            resonated through the water. Witnessing their breaches and hearing their melodic calls was a
                            truly awe-inspiring experience.</p>
                    </div>
                </div>
                <div class="post-area-divider"></div>
                <div class="recent-dive-area">
                    <div class="recent-dive-header">
                        <h3>Coral Paradise</h3>
                        <span>07/05/23</span>
                    </div>
                    <div class="recent-dive-content">
                        <p>As I descended into the coral reef, I was greeted by a vibrant
                            explosion of colors. The underwater world was teeming with life. I swam alongside elegant
                            manta
                            rays and marveled at the intricate structures of the coral. It was a true paradise for
                            marine
                            enthusiasts like me.</p>
                    </div>
                </div>
                <div class="post-area-divider"></div>
                <div class="recent-dive-area">
                    <div class="recent-dive-header">
                        <h3>Sunken Secrets</h3>
                        <span>15/03/23</span>
                    </div>
                    <div class="recent-dive-content">
                        <p>I descended into the depths to explore the remains of an ancient
                            shipwreck. As I swam through hidden chambers, I discovered coral-encrusted artifacts and
                            encountered a vibrant school of tropical fish, their colors shimmering in the sunlight.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>