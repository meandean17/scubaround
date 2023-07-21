<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_SESSION['user_id'];
    $diveName = $_POST['diveName'];
    $diveDescription = $_POST['diveDescription'];
    $isPublic = isset($_POST['isPublic']) ? 1 : 0;

    try {
        // Create a PDO instance for database connection
        $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL query to update the dive information
        $query = "UPDATE tbl_226_dives SET dive_name = :diveName, dive_description = :diveDescription, is_public = :isPublic WHERE user_id = :userID";
        $stmt = $pdo->prepare($query);

        // Bind the parameters
        $stmt->bindParam(':diveName', $diveName, PDO::PARAM_STR);
        $stmt->bindParam(':diveDescription', $diveDescription, PDO::PARAM_STR);
        $stmt->bindParam(':isPublic', $isPublic, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Handle any further processing or redirection as required
        // ...
    } catch (PDOException $e) {
        // Handle database connection errors
        echo "Database Error: " . $e->getMessage();
    }
}
?>
