
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'config.php';


// Create a PDO instance for database connection
$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $userType = "user"; // Set a default user type
    $userImg = ""; // Set an empty default user image path

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Store the user data in the database
    $query = "INSERT INTO tbl_226_users (username, password, age, email, user_type, user_img) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username, $hashedPassword, $age, $email, $userType, $userImg]);
    
  
    header("Location: ../login.html");
    exit();
}
?>
