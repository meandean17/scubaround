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
    // $stmt->bindParam(':diveType', $diveType, PDO::PARAM_STR);

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
     
     $startPointLat = mt_rand(29000000, 29999999) / 1000000.0; // Example: random latitude between 29.000000 and 29.999999
     $startPointLon = mt_rand(340000000, 349999999) / 1000000.0; // Example: random longitude between 34.000000 and 34.999999
     $endPointLat = mt_rand(29000000, 29999999) / 1000000.0;
     $endPointLon = mt_rand(340000000, 349999999) / 1000000.0;
    // Prepare the SQL query to insert the start and end points
    $query = "INSERT INTO tbl_226_routes (route_type, start_point_lat, start_point_lon, end_point_lat, end_point_lon) VALUES (:routeType, :startPointLat, :startPointLon, :endPointLat, :endPointLon)";
    $stmt = $pdo->prepare($query);

    
    // Bind the parameters
    $stmt->bindParam(':routeType', $diveType, PDO::PARAM_STR);
    $stmt->bindParam(':startPointLat', $startPointLat, PDO::PARAM_STR);
    $stmt->bindParam(':startPointLon', $startPointLon, PDO::PARAM_STR);
    $stmt->bindParam(':endPointLat', $endPointLat, PDO::PARAM_STR);
    $stmt->bindParam(':endPointLon', $endPointLon, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Get the inserted route ID
    $routeID = $pdo->lastInsertId();


    // Prepare the SQL query to insert dive details
    $query = "INSERT INTO tbl_226_dive_details (dive_id, dive_date, dive_duration, dive_distance, dive_temp, dive_o2, dive_max_depth, dive_heartrate) 
              VALUES (:diveID, CURDATE(), :diveDuration, :diveDistance, :diveTemp, :diveO2, :diveMaxDepth, :diveHeartRate)";
    $stmt = $pdo->prepare($query);

    // Generate random dive details
    $diveDuration = mt_rand(10, 90);
    $diveDistance = mt_rand(100, 3500);
    $diveTemp = mt_rand(1, 30);
    $diveO2 = mt_rand(0, 100);
    $diveMaxDepth = mt_rand(5, 60);
    $diveHeartRate = mt_rand(50, 200);

    // Bind the parameters
    $stmt->bindParam(':diveID', $diveID, PDO::PARAM_INT);
    $stmt->bindParam(':diveDuration', $diveDuration, PDO::PARAM_INT);
    $stmt->bindParam(':diveDistance', $diveDistance, PDO::PARAM_INT);
    $stmt->bindParam(':diveTemp', $diveTemp, PDO::PARAM_INT);
    $stmt->bindParam(':diveO2', $diveO2, PDO::PARAM_INT);
    $stmt->bindParam(':diveMaxDepth', $diveMaxDepth, PDO::PARAM_INT);
    $stmt->bindParam(':diveHeartRate', $diveHeartRate, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

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
?>
