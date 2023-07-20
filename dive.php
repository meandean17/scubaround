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
        $diveId = $_GET['dive_id'];
        $query = "SELECT * FROM tbl_226_dives 
        INNER JOIN tbl_226_dive_details using (dive_id)
        WHERE dive_id='" . $diveId . "'";

        $result = mysqli_query($connection, $query);
        if($result)
        {
            $row = mysqli_fetch_array($result);

            $diveName = $row['dive_name'];
            $diveDesc = $row['dive_description'];
            $diveStatus = $row['is_public'];
            $diveDate = $row['dive_date'];
            $diveDur = $row['dive_duration'];
            $diveDist = $row['dive_distance'];
            $diveTemp = $row['dive_temp'];
            $diveO2 = $row['dive_o2'];
            $diveMaxDepth = $row['dive_max_depth'];
            $diveHeart = $row['dive_heartrate'];
        }
        else {
            $row = false;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            echo $diveName
        ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="./js/index.js" defer></script>
    <script src="./js/main.js" defer></script>
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
                        <!-- yes -->
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
                        <a href="#">
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
                <img src="./imgs/profile-icon.png" alt="profile logo" class="profile-logo">
            </div>
        </div>
    </header>
    <div class="scub-container content-background">
        <div class="main-header scub-row-space-bet">
            <?php
                if($row)
                {
                    echo "<h2 id='dive-object-title'>" . $diveName . "</h2>";
                    echo "<h2>" . $diveDate . "</h3>";
                    echo "<label class='item-status'>" . ($diveStatus) ? 'Public' : 'Private' . "</label>";
                    echo "<label class='status-toggle'>";
                    echo "<input type='checkbox' class='checkbox' onchange='onToggleChange()' onload='setToggleValue()'>";
                    echo "<span class='slider'></span>";
                    echo "<span class='labels' data-on='Private' data-off='Public'></span>";
                    echo "</label>";
                    echo "";
                }
            ?>
        </div>
        <div class="dive-detail-box">
            <div class="detail-row">
                <div class="detail">
                    <span class="label">Duration:</span>
                    <span class="value">75 minutes</span>
                </div>
                <div class="detail">
                    <span class="label">Max Depth:</span>
                    <span class="value">30 meters</span>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail">
                    <span class="label">Distance:</span>
                    <span class="value">10 kilometers</span>
                </div>
                <div class="detail">
                    <span class="label">Avg Depth:</span>
                    <span class="value">15 meters</span>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail">
                    <span class="label">Avg Temp:</span>
                    <span class="value">25°C</span>
                </div>
                <div class="detail">
                    <span class="label">Max Temp:</span>
                    <span class="value">28°C</span>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail">
                    <span class="label">Oxygen Consumption:</span>
                    <span class="value">10 liters</span>
                </div>
                <div class="detail">
                    <span class="label">Avg Heart Rate:</span>
                    <span class="value">120 bpm</span>
                </div>
            </div>
        </div>
        <div class="text-section">
            <p>I ventured into a mysterious underwater cave system, my
                flashlight
                illuminating the dark passages. The cave walls were adorned with breathtaking stalactite
                formations, and the water sparkled with bioluminescent creatures. I was amazed by the
                graceful
                shark that swam past me, seemingly at home in this otherworldly realm.</p>
        </div>
        <div class="main-header">
            <h2>Dive Gallery</h2>
        </div>
        <div class="container-slides">
            <div class="mySlides">
                <div class="numbertext">1 / 3</div>
                <img src="./imgs/dive.jpg" style="width:100%">
            </div>
            <div class="mySlides">
                <div class="numbertext">2 / 3</div>
                <img src="./imgs/shark.jpg" style="width:100%">
            </div>
            <div class="mySlides">
                <div class="numbertext">3 / 3</div>
                <img src="./imgs/jellyfish.jpg" style="width:100%">
            </div>
            <div class="arrows">
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <!-- Image text -->
            <div class="caption-container">
                <p id="caption"></p>
            </div>
        </div>
        <div class="dive-object-options scub-row-space-bet">
            <button class="button">Edit</button>
            <button class="button">Post</button>
            <button class="button">Share</button>
        </div>

</body>

</html>