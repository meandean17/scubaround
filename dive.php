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
                    echo "<label class='item-status "  . ($diveStatus ? 'public' : 'private') .  "' id='diveStatus' data-status='" . ($diveStatus ? 'Public' : 'Private') . "'>" . ($diveStatus ? 'Public' : 'Private') . "</label>";
                    echo "<label class='status-toggle'>";
                    echo "<input type='checkbox' class='checkbox' onchange='onToggleChange()' onload='setToggleValue()'>";
                    echo "<span class='slider'></span>";
                    echo "<span class='labels' data-on='Private' data-off='Public'></span>";
                    echo "</label>";
                    echo "</div>";
                }
            ?>
        
        <div class="dive-detail-box">
            <?php
                echo "<div class='detail-row'>";
                    echo "<div class='detail'>";
                        echo "<span class='label'>Duration:</span>";
                        echo "<span class='value'>" . $diveDur . " minutes</span>";
                    echo "</div>";
                    echo "<div class='detail'>";
                        echo "<span class='label'>Max Depth:</span>";
                        echo "<span class='value'>" . $diveMaxDepth . " meters</span>";
                    echo "</div>";
                echo "</div>";

                echo "<div class='detail-row'>";
                    echo "<div class='detail'>";
                        echo "<span class='label'>Distance:</span>";
                        echo "<span class='value'>" . $diveDist . " kilometers</span>";
                    echo "</div>";
                    echo "<div class='detail'>";
                        echo "<span class='label'>Avg Temp:</span>";
                        echo "<span class='value'>" . $diveTemp . " °C</span>";
                    echo "</div>";
                echo "</div>";

                echo "<div class='detail-row'>";
                    echo "<div class='detail'>";
                        echo "<span class='label'>Oxygen Consumption:</span>";
                        echo "<span class='value'>" . $diveO2 . " liters</span>";
                    echo "</div>";
                    echo "<div class='detail'>";
                        echo "<span class='label'>Avg Heart Rate:</span>";
                        echo "<span class='value'>" . $diveHeart . " bpm</span>";
                    echo "</div>";
                echo "</div>";
            ?>
        </div>
        <?php
            echo "<div class='text-section'>";
            echo "<p class='dive-desc'>" . $diveDesc . "</p>";
            echo "</div>";
        ?>
        <?php
            echo "<div class='main-header'>";
            echo "<h2>Dive Gallery</h2>";
            echo "</div>";
        ?>
        <?php
            $query = "SELECT * from tbl_226_dive_images WHERE dive_id='" . $diveId . "'";
            $result = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($result))
            {   
                $imgUrl = $row['img_src'];
                $i = 1;
                $total = mysqli_num_rows($result);
                echo "<div class='container-slides'>";
                echo "<div class='mySlides'>";
                echo "<div class='numbertext'>" . $i . '/' . $total . "</div>";
                echo "<img src='" . $imgUrl . "' style='width:100%'>";
                echo "</div>";
                $i++;
            }
        ?>
        <div class="dive-object-options scub-row-space-bet">
            <button class="button" name='edit' id="editBtn">Edit</button>
            <button class="button share-dive-btn" id='postBtn'>Post</button>
            <button class="button share-dive-btn" id='shareBtn'>Share</button>
            <button class="button alter-dive-btn" onclick="saveChanges()" name='save' id='saveBtn'>Save</button>
            <button class="button alter-dive-btn" onclick="deleteDive()" name='delete' id='deleteBtn'>Delete</button>
            <button class="button alter-dive-btn" name='cancel' id='cancelBtn'>Cancel</button>

        </div>
        <div class="error-msg-box">
            
        </div>
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-close-and-dialogue">
                    <p>Are you sure you want to delete this dive?</p>
                    <span class="close">&times;</span>
                </div>
                <button class="button delete-dive-btn" onclick="deleteDive2()" name='confirmDelete' id='deleteBtn2'>Delete</button>
            </div>
        </div>
        <?php
            // if(isset($_POST))
            // {
            //     if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
            //         $url = "https://";   
            //     else  
            //         $url = "http://";   
            //     // Append the host(domain name, ip) to the URL.   
            //     $url.= $_SERVER['HTTP_HOST'];   
                
            //     // Append the requested resource location to the URL   
            //     $url.= $_SERVER['REQUEST_URI'];    
                
            //     $opts = array( 'http'=>array( 'method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: ".session_name()."=".session_id()."\r\n" ) );
            //     $context = stream_context_create($opts);
            //     session_write_close();   // this is the key
            //     $page = file_get_contents($url, false, $context);


            //     libxml_use_internal_errors(true);
            //     $doc = new DOMDocument;
            //     $doc->loadHTML($page);
            //     $xpath = new DOMXpath( $doc);

            //     // fetching the text in the description paragraph
            //     $newDesc = $xpath->query('//a[@class="dive-desc"]')->item(0);
            //     $newName = $xpath->query('//h2[@id="dive-object-title"]')->item(0);
            //     $newStatus = $xpath->query('//input[@class="checkbox"]')->item(0);
                
            //     // echo $newDesc->textContent; // This will print **GET THIS TEXT*
            //     // echo $newName->textContent;
            //     // echo ($newStatus->getAttribute('checked') ? "yes" : "no");
            //     // echo "dn";
            //     $query2 = "UPDATE tbl_226_dives SET dive_name ='" . ($newName->textContent ? $newName->textContent : "unnamed dive")  ."', dive_description =' " . ($newDesc->textContent ? $newDesc->textContent : "-")  . "', is_public='" . ($newStatus->getAttribute('checked') ? "true" : "false") . "' WHERE dive_id=" . $diveId . "";
            //     $result = mysqli_query($connection, $query);

            //     if(!$result)
            //     {
            //         echo "Database error";
            //     }

            // }
        ?>

</body>

</html>