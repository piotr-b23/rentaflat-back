<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $rateId = $_POST['rateId'];
    $contactRate = $_POST['contactRate'];
    $descriptionRate = $_POST['descriptionRate'];
    $comment = $_POST['comment'];
    $date = $_POST['date'];


    require_once 'conn.php';

    $sql = "UPDATE rate SET contactRate='$contactRate',descriptionRate='$descriptionRate',comment='$comment',date='$date' WHERE id='$rateId' ";


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