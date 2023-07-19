<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'config.php';

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or display an error message
    header("Location: ./login.html");
    exit();
}

// Retrieve user ID from session
$userID = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the dive name and dive type from the form submission
    $diveName = $_POST['diveName'];
    $diveType = $_POST['diveType'];

    try {
        // Create a PDO instance for database connection
        $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Generate random latitude and longitude values within the specified range
        // $startLat = mt_rand(29000000, 29999999) / 1000000.0; // Example: random latitude between 29.000000 and 29.999999
        // $startLon = mt_rand(340000000, 349999999) / 1000000.0; // Example: random longitude between 34.000000 and 34.999999
        // $endLat = mt_rand(29000000, 29999999) / 1000000.0;
        // $endLon = mt_rand(340000000, 349999999) / 1000000.0;

        // Insert the new dive into tbl_226_dives
        $query = "INSERT INTO tbl_226_dives (user_id, dive_name, dive_description, is_public) VALUES (:userID, :diveName, NULL, TRUE)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':diveName', $diveName, PDO::PARAM_STR);
        $stmt->execute();

        // Get the dive ID of the newly inserted dive
        $diveID = $pdo->lastInsertId();

        // Insert the dive type into tbl_226_routes
        $query = "INSERT INTO tbl_226_routes (route_type, start_point_lat, start_point_lon, end_point_lat, end_point_lon) VALUES (:diveType, :startLat, :startLon, :endLat, :endLon)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':diveType', $diveType, PDO::PARAM_STR);
        $stmt->bindParam(':startLat', $startLat, PDO::PARAM_STR);
        $stmt->bindParam(':startLon', $startLon, PDO::PARAM_STR);
        $stmt->bindParam(':endLat', $endLat, PDO::PARAM_STR);
        $stmt->bindParam(':endLon', $endLon, PDO::PARAM_STR);
        $stmt->execute();

        // Update the dive record with the route ID
        $routeID = $pdo->lastInsertId();
        $query = "UPDATE tbl_226_dives SET route_id = :routeID WHERE dive_id = :diveID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':routeID', $routeID, PDO::PARAM_INT);
        $stmt->bindParam(':diveID', $diveID, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect the user to the dive history page or display a success message
        header("Location: ./list.php");
        exit();
    } catch (PDOException $e) {
        // Handle database connection errors
        echo "Database Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dive Object</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="./js/index.js" defer></script>
    <script src="./js/dive.js" defer></script>
</head>

<body>
    <header class="header">
        <div class="scub-container scub-row-space-bet">
            <div class="nav-and-logo scub-row">
                <div class="hamburger-button">
                    <span onclick="openNav()" class="hamburger"></span>
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a href="./index.html">
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
                        <a href="./dive.html">
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
                <a href="./index.html"><img src="./imgs/logo.png" alt="scubaround logo" class="logo"></a>
            </div>
            <div class="search-and-profile">
                <img src="./imgs/profile-icon.png" alt="profile logo" class="profile-logo">
            </div>
        </div>
    </header>
    <form action="" method="post" class="route-creation-form">
        <div class="scub-container content-background">
            <div class="main-header">
                <h2>Dive Name:</h2>
            </div>
            <input type="text" name="diveName" required>

            <div class="main-header">
                <h2>Dive type:</h2>
            </div>
            <select name="diveType" id="diveType" class="form-select" aria-label="Default select example">
                <option selected value="free dive">Free Dive</option>
                <option value="draw route">Draw Route</option>
                <option value="existing route">Existing Route</option>
                <option value="new route">New Route</option>
            </select>
            <div class="main-header">
                <h2>Create Route:</h2>
            </div>
            <div class="route-creation">
                <div class="route-start">
                    <div class="point-selection">
                        <span>Starting Point</span>
                    </div>
                    <div id="map-starting-point" class="dive-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1188.5793530542817!2d34.953355154013316!3d29.54764125114067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x150071e324795e0b%3A0xfe1d95f85577f6db!2sEilat!5e0!3m2!1sen!2sil!4v1684789457356!5m2!1sen!2sil"
                            width="250" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="dive-map-medium">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d879.2595146630498!2d34.95389451411292!3d29.547478523677306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sil!4v1684782456659!5m2!1sen!2sil"
                            width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="route-end">
                    <div class="point-selection">
                        <span>Ending Point</span>
                    </div>
                    <div id="map-ending-point" class="dive-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1188.5793530542817!2d34.953355154013316!3d29.54764125114067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x150071e324795e0b%3A0xfe1d95f85577f6db!2sEilat!5e0!3m2!1sen!2sil!4v1684789457356!5m2!1sen!2sil"
                            width="250" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="dive-map-medium">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d879.2595146630498!2d34.95389451411292!3d29.547478523677306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sil!4v1684782456659!5m2!1sen!2sil"
                            width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </div>
            <div class="scub-container save-dive content-background">
                <button type="submit" class="button">Save</button>
                <button type="submit" class="button">Save as Draft</button>
            </div>
    </form>
</body>

</html>
