<?php
// Database connection credentials
$dbhost = "148.66.138.145";
$dbuser = "dbusrShnkr23";
$dbpass = "studDBpwWeb2!";
$dbname = "dbShnkr23stud2";

try {
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Perform CRUD operations using SQL queries
    // Create operation
    $query = "INSERT INTO tbl_226_dives (user_id, route_id, dive_name, dive_description, is_public) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);

    $user_id = 1; // Example user_id
    $route_id = 1; // Example route_id
    $dive_name = "My Dive";
    $dive_description = "This is a description of my dive.";
    $is_public = 1; // Example is_public (1 for true, 0 for false)

    $stmt->execute([$user_id, $route_id, $dive_name, $dive_description, $is_public]);

    echo "Dive created successfully.";

    // Close the database connection
    $pdo = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
