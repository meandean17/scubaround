<?php
    include "config.php";
    session_start(); // start session

    // check for login
    if (!isset($_SESSION["username"])) {
        header("location: ./login.php");
        exit; // prevent further execution
    }
    error_log(print_r($_POST, true));
    if (isset($_POST['dive_id']) && isset($_POST['dive_name']) && isset($_POST['dive_desc']) && isset($_POST['dive_status'])) {
        $newName = $_POST['dive_name'];
        $newDesc = $_POST['dive_desc'];
        $newStatus = $_POST['dive_status'];
        $diveId = $_POST['dive_id'];
        // Save the edited content to the database or perform any other required actions
        $query = "UPDATE tbl_226_dives SET dive_name = '" .$newName . "', dive_description= '" . $newDesc . "', is_public='" . ($newStatus == "Public" ? "Public" : "Private") . " WHERE dive_id='" . $diveId . "'";


        // Respond with the edited content to update the page
        $result = mysqli_query($connection, $query);
        if($result){
            // After successful deletion, return a response to indicate success
            echo "Dive edited successfully.";
        }
}
?>