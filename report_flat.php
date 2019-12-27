<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $flatId = $_POST['flatId'];
    $reportingUserId = $_POST['reportUserId'];
    $comment = $_POST['comment'];
    $date = $_POST['date'];


    require_once 'conn.php';

    $stmt =$conn->prepare("INSERT INTO flatreport(flatId,reportingUserId, comment, date) VALUES(?,?,?,?)");
    $stmt->bind_param("iiss",$flatId, $reportingUserId, $comment, $date);

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