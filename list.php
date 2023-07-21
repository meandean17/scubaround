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
    <title>Dive History</title>
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
    <script type="module" src="js/favorites.js" defer></script>
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

    <div class="scub-container">
        <div class="content-background">
            <div class="main-header">
                <h2>Dive History</h2>
                <form action="#" method="get" class="search-form">
                    <input type="search" class="form-control search-bar" placeholder="Search here..." name="keyword" value="<?php echo isset($_POST['keyword']) ? $_POST['keyword'] : '' ?>"/>
                    <button class="btn btn-primary search-btn" name="search">&#x1F50E;&#xFE0E;</button>
                </form>
            </div>
            <ul id="diveList" class="dive-list">
                <?php
                    $keyword = "";
                    if(ISSET($_GET['search']))
                        $keyword = $_GET['keyword'];
                    
                    if($keyword)    //if search occured
                    {
                        $query = "SELECT dives.dive_id, dives.dive_name, dives.is_public, details.dive_date, details.dive_duration, dives.dive_description
                        FROM tbl_226_dives AS dives
                        INNER JOIN tbl_226_dive_details AS details ON dives.dive_id = details.dive_id
                        WHERE dives.user_id =  '" . $_SESSION["user_id"] . "' AND (dives.dive_name LIKE '%" . $keyword . "%')";
                    }
                    else {  //if search didnt occur
                        $query = "SELECT dives.dive_id, dives.dive_name, dives.is_public, details.dive_date, details.dive_duration, dives.dive_description
                        FROM tbl_226_dives AS dives
                        INNER JOIN tbl_226_dive_details AS details ON dives.dive_id = details.dive_id
                        WHERE dives.user_id =  '" . $_SESSION["user_id"] . "'";
                    }
                    $result = mysqli_query($connection, $query);
                    if(!mysqli_num_rows($result))
                    {
                        echo "<div class='dive-list-item' style='justify-content:center'>No dives found</div>";
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
                            
                            echo '<a href="./dive.php?dive_id=' . $diveId . '" class="dive-list-item">';
                            echo "<div class='dive-name'>" . $diveName . "</div>";
                            echo "<div class='dive-date'>" . $diveDate . "</div>";
                            echo "<div class='dive-status " . ($diveStatus ? 'public' : 'private') . "'>" . ($diveStatus ? 'Public' : 'Private') . "</div>";
                            echo "<div class='dive-duration'>" . $diveDur . "</div>";
                            echo "<div class='dive-description'>" . ($diveDesc ? $diveDesc : "-") . "</div>";
                            echo "</a>";
                        }                    
                    }
                ?>
            </ul>
        </div>
    </div>

</body>

</html>