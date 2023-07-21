<?php
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $diveName = $_GET['diveName'];
    $diveType = $_GET['diveType'];


    $query = "INSERT INTO tbl_226_dives (user_id, dive_name, dive_description, is_public) VALUES ('" . $userID . "', '" . $diveName . "', '', 1)";
    $result = mysqli_query($connection, $query);

    if($result)
    {
        $query = "SELECT dive_id from tbl_226_dives ORDER BY dive_id DESC LIMIT 1";
        $result = mysqli_query($connection, $query);
        if($result)
        {
            $diveID = mysqli_fetch_array($result);
            $startPointLat = mt_rand(29000000, 29999999) / 1000000.0; // Example: random latitude between 29.000000 and 29.999999
            $startPointLon = mt_rand(340000000, 349999999) / 1000000.0; // Example: random longitude between 34.000000 and 34.999999
            $endPointLat = mt_rand(29000000, 29999999) / 1000000.0;
            $endPointLon = mt_rand(340000000, 349999999) / 1000000.0;
            $query = "INSERT INTO tbl_226_routes (route_type, start_point_lat, start_point_lon, end_point_lat, end_point_lon) VALUES ('" . $diveType . "', " . $startPointLat . "', " . $startPointLon . "', " . $endPointLat . "', " . $endPointLon . "')";
            $result = mysqli_query($connection, $query);
            if($result)
            {
                $query = "SELECT route_id from tbl_226_routes ORDER BY route_id DESC LIMIT 1";
                $result = mysqli_query($connection, $query);
                $routeID = mysqli_fetch_array($result)['route_id'];
                if($routeID)
                {
                    // Generate random dive details
                    $diveDuration = mt_rand(10, 90);
                    $diveDistance = mt_rand(100, 3500);
                    $diveTemp = mt_rand(1, 30);
                    $diveO2 = mt_rand(0, 100);
                    $diveMaxDepth = mt_rand(5, 60);
                    $diveHeartRate = mt_rand(50, 200);
                    $query = "INSERT INTO tbl_226_dive_details (dive_id, dive_date, dive_duration, dive_distance, dive_temp, dive_o2, dive_max_depth, dive_heartrate) 
                    VALUES ('" . $diveID . "', CURDATE(), '" . $diveDuration . "', '" . $diveDistance . "', '" . $diveTemp . "', '" . $diveO2. "', '" . $diveMaxDepth . "', '" . $diveHeartRate . "')";
                    $result = mysqli_query($connection, $query);
                    if($result)
                    {
                        $query = "UPDATE tbl_226_dives SET route_id =" . $routeID . " WHERE dive_id = " . $diveID . "";
                        $result = mysqli_query($connection, $query);
                        if($result)
                            Header("Location: ./list.php");
                        else
                            echo "Database error";
                    }
                    else {
                        echo "Database error";
                    }

                }
                else {
                    echo "Database error";
                }
    
            }
        }
    }
}
?>