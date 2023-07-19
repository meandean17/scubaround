<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once 'config.php';
    session_start();


    try {
        $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Database connection successful!";
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
    
    
    
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve username and password from the form submission
        $username = $_POST["username"];
        $password = $_POST["password"];
    
        // Proceed with authentication
        $query = "SELECT * FROM tbl_226_users WHERE username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Check if user exists and the password matches
        if ($user && password_verify($password, $user["password"])) {
            // Authentication successful
            // Redirect the user to their profile page or the main application page
            $_SESSION["user_id"] = $user["user_id"];
            header("Location: ../home.html");
            exit();
        } else {
            // Authentication failed
            // Display an error message to the user
            echo "Invalid username or password.";
        }
    }
?>

    