<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $rateId = $_POST['rateId'];
    $reportingUserId = $_POST['reportingUserId'];
    $comment = $_POST['comment'];
    $date = $_POST['date'];


    require_once 'conn.php';

    $stmt =$conn->prepare("INSERT INTO ratereport(rateId,reportingUserId, comment, date) VALUES(?,?,?,?)");
    $stmt->bind_param("iiss",$rateId, $reportingUserId, $comment, $date);

    if($stmt->execute()) {

        $response["success"] = "1";

        echo json_encode($response);
        mysqli_close($conn);
        

    }else {
        $response["success"] = "0";

        echo json_encode($response);
        mysqli_close($conn);

    }

}