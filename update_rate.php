<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $rateId = $_POST['rateId'];
    $contactRate = $_POST['contactRate'];
    $descriptionRate = $_POST['descriptionRate'];
    $comment = $_POST['comment'];
    $date = $_POST['date'];


    require_once 'conn.php';

    $stmt =$conn->prepare("UPDATE rate SET contactRate=?,descriptionRate=?,comment=?,date=? WHERE id=?");
    $stmt->bind_param("ddssi",$contactRate, $descriptionRate, $comment, $date, $rateId);


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