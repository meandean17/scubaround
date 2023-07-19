<?php
// Database connection credentials
    $dbhost = "148.66.138.145";
	$dbuser = "dbusrShnkr23";
	$dbpass = "studDBpwWeb2!";
	$dbname = "dbShnkr23stud2";


// Create a connection to the database
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Rest of your create.php code goes here
?>
