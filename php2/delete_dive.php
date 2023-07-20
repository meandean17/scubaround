<?php
    include "config.php";

    session_start(); // start session

    // check for login
    if (!isset($_SESSION["username"])) {
        header("location: ./login.php");
        exit; // prevent further execution
    }

    if (isset($_POST['deleteDive'])) {
        $diveIdToDelete = $_POST['deleteDive'];
        
        // TODO: Delete the dive with ID $diveIdToDelete from the database
        // Perform the database deletion here using SQL DELETE statement
        $query = "DELETE FROM tbl_226_dives WHERE dive_id=" . $diveIdToDelete . "";

        $result = mysqli_query($connection, $query);
        if($result){
            // After successful deletion, return a response to indicate success
            echo "Dive deleted successfully.";
        }
    }
?>