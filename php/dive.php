<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.html");
    exit();
}

$userID = $_SESSION['user_id'];

$diveName = $_GET['diveName'];
$diveType = $_GET['diveType'];
$startPointLat = $_GET['startPointLat'];
$startPointLon = $_GET['startPointLon'];
$endPointLat = $_GET['endPointLat'];
$endPointLon = $_GET['endPointLon'];


try {
    // Create a PDO instance for database connection
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL query to insert the dive type
    $query = "INSERT INTO tbl_226_dives (user_id, dive_name, dive_description, is_public) VALUES (:userID, :diveName, '', 1)";
    $stmt = $pdo->prepare($query);

    // Bind the parameters
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->bindParam(':diveName', $diveName, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Get the inserted dive ID
    $diveID = $pdo->lastInsertId();

    // Handle any further processing or redirection as required
    // ...
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Database Error: " . $e->getMessage();
}


try {
    // Prepare the SQL query to insert the start and end points
    $query = "INSERT INTO tbl_226_routes (route_type, start_point_lat, start_point_lon, end_point_lat, end_point_lon) VALUES (:routeType, :startPointLat, :startPointLon, :endPointLat, :endPointLon)";
    $stmt = $pdo->prepare($query);

    
    // Bind the parameters
    $routeType = 'new route'; // Assuming it's a new route for simplicity
    $stmt->bindParam(':routeType', $routeType, PDO::PARAM_STR);
    $stmt->bindParam(':startPointLat', $startPointLat, PDO::PARAM_STR);
    $stmt->bindParam(':startPointLon', $startPointLon, PDO::PARAM_STR);
    $stmt->bindParam(':endPointLat', $endPointLat, PDO::PARAM_STR);
    $stmt->bindParam(':endPointLon', $endPointLon, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Get the inserted route ID
    $routeID = $pdo->lastInsertId();

    // Handle any further processing or redirection as required
    // ...
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Database Error: " . $e->getMessage();
}


try {
    // Prepare the SQL query to update the dive with the route ID
    $query = "UPDATE tbl_226_dives SET route_id = :routeID WHERE dive_id = :diveID";
    $stmt = $pdo->prepare($query);

    // Bind the parameters
    $stmt->bindParam(':routeID', $routeID, PDO::PARAM_INT);
    $stmt->bindParam(':diveID', $diveID, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Handle any further processing or redirection as required
    // ...
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Database Error: " . $e->getMessage();
}
