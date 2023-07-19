<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 require_once 'config.php';
 
  $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  // Retrieve the user ID from the session or any other relevant information
  session_start();
  $userID = $_SESSION['user_id'];
  
  // Perform the necessary database query to fetch the user-specific data
  $query = "SELECT * FROM your_table WHERE user_id = :userID"; // Modify this query to match your table structure
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':userID', $userID);
  $stmt->execute();
  $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  // Return the data as a JSON response
  header('Content-Type: application/json');
  echo json_encode($userData);
?>
