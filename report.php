<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $faltid = $_POST['flatid'];
    $reportingUserId = $_POST['reportUserId'];
    $comment = $_POST['comment'];
    $date = $_POST['date'];


    require_once 'conn.php';

    $sql = "INSERT INTO report(flatId,reportingUserId, comment, date) VALUES('$faltid','$reportingUserId','$comment','$date')";

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