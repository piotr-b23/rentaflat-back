<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $userId = $_POST['flatid'];
    $raterId = $_POST['reportUserId'];
    $contactRate = $_POST['comment'];
    $descriptionRate = $_POST['flatid'];
    $comment = $_POST['comment'];
    $date = $_POST['date'];


    require_once 'conn.php';

    $sql = "INSERT INTO rate(userId,raterId, contactRate, descriptionRate, comment, date) VALUES('$userId','$raterId','$contactRate','$descriptionRate','$comment','$date')";

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