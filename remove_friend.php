<?php
// Include your database connection configuration file
include "./php2/config.php";
session_start();
if (isset($_SESSION["user_id"])) {
    $currentUserID = intval($_SESSION["user_id"]);

// Check if the request is a POST request and if the friend_user_id is set
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["friend_user_id"])) {
    // Sanitize and validate the friend_user_id
    $friendUserID = intval($_POST["friend_user_id"]);

    // Check if the current user is logged in
   

        // Check if the current user and the friend are actually friends in the friendship table
        $query = "DELETE FROM tbl_226_friendship
                  WHERE (user1_id = $currentUserID AND user2_id = $friendUserID)
                  OR (user1_id = $friendUserID AND user2_id = $currentUserID)";
        $result = mysqli_query($connection, $query);

                    if ($result) {
                        echo "success";
                    } else {
                        // Friend removal failed
                        echo "error";
                    }
    } 
} else {
    echo "error";
}
?>
