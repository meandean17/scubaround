<?php
    include "config.php"
    session_start(); // start session

    // check for login
    if (!isset($_SESSION["username"])) {
        header("location: ./login.php");
        exit; // prevent further execution
    }

    if (isset($_POST['dive_id']) isset($_POST['dive_name']) && isset($_POST['dive_desc'])) {
        $newName = $_POST['dive_name'];
        $newDesc = $_POST['dive_desc'];
        $diveId = $_POST['dive_id'];
        // Save the edited content to the database or perform any other required actions
        $query = "UPDATE tbl_226_dives SET dive_name = '" .$newName . "', dive_description= '" . $newDesc . "' WHERE dive_id='" . $diveId . "'";


        // Respond with the edited content to update the page
        $response = array('dive_name' => $newName, 'dive_desc' => $newDesc);
        echo json_encode($response);
}
?>