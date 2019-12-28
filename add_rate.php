<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $userId = $_POST['userId'];
    $raterId = $_POST['raterId'];
    $contactRate = $_POST['contactRate'];
    $descriptionRate = $_POST['descriptionRate'];
    $comment = $_POST['comment'];
    $date = $_POST['date'];


    require_once 'conn.php';

    $stmt =$conn->prepare("INSERT INTO rate(userId,raterId, contactRate, descriptionRate, comment, date) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("iiddss",$userId,$raterId,$contactRate,$descriptionRate,$comment,$date);

    if($raterId != $userId)
    {
    if($stmt->execute()) {

        $response["success"] = "1";
        $response["message"] = "success"

        echo json_encode($response);
        mysqli_close($conn);
        

    }else {
        $response["success"] = "0";
        $response["message"] = "error"

        echo json_encode($response);
        mysqli_close($conn);

    }
}
else {
    $response["success"] = "0";
    $response["message"] = "same user"

    echo json_encode($response);
    mysqli_close($conn);
}

}