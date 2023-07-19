<?php
session_start();
// echo $_SESSION["user_id"];
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require_once 'config.php';
// echo "Database connection successful!";
// session_start();

// echo $_SESSION;

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or display an error message
    header("Location: ../login.html");
    exit;
}

//Retrieve user ID from session

// $userID = 1;



try {
    $userID = $_SESSION['user_id'];
    // Create a PDO instance for database connection
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL query to retrieve dive history
    $query = "SELECT dives.dive_name, dives.is_public, details.dive_date, details.dive_duration
              FROM tbl_226_dives AS dives
              INNER JOIN tbl_226_dive_details AS details ON dives.dive_id = details.dive_id
              WHERE dives.user_id = :userID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the dive history data
    $diveHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the dive history data for debugging
    // echo "<pre>";
    // print_r($diveHistory);
    // echo "</pre>";

    // Convert the dive history to JSON format
    $json = json_encode($diveHistory);

    // Send the JSON response
    header('Content-Type: application/json');
    echo $json;
        
} 
    catch (PDOException $e) {
        // Handle database connection errors
        echo "Database Error: " . $e->getMessage();
}

// function utf8ize($d) {                      
//     if (is_array($d)) {
//         foreach ($d as $k => $v) {
//             $d[$k] = utf8ize($v);
//         }
//     } else if (is_string ($d)) {
//         return mb_convert_encoding($d, 'UTF-8', 'ISO-8859-1');
//     }
//     return $d;
// }
?>

