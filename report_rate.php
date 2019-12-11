<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $rateId = $_POST['rateId'];
    $reportingUserId = $_POST['reportingUserId'];
    $comment = $_POST['comment'];
    $date = $_POST['date'];


    require_once 'conn.php';

    $sql = "INSERT INTO ratereport(rateId,reportingUserId, comment, date) VALUES('$rateId','$reportingUserId','$comment','$date')";

    if(mysqli_query($conn, $sql)) {

        $result["success"] = "1";
        $result["message"] = "success";

        echo json_encode($result);
        mysqli_close($conn);
        

    }else {
        $result["success"] = "0";
        $result["message"] = "error";

        echo json_encode($result);
        mysqli_close($conn);

    }

}