<?php

include "auth.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $token = $_SERVER['HTTP_AUTHORIZATION_TOKEN'];

    $rateId = $_POST['rateId'];
    $contactRate = $_POST['contactRate'];
    $descriptionRate = $_POST['descriptionRate'];
    $comment = $_POST['comment'];
    $userId = $_POST['userId'];

    date_default_timezone_set('Poland');
    $date = date('Y-m-d');

    require_once 'conn.php';

    $stmt = $conn->prepare("UPDATE rate SET contactRate=?,descriptionRate=?,comment=?,date=? WHERE id=? AND raterId = ?");
    $stmt->bind_param("ddssis", $contactRate, $descriptionRate, $comment, $date, $rateId, $userId);

    $auth = authorization($userId, $token);

    if ($auth === 1) {
        if ($stmt->execute()) {
            $response["success"] = "1";

            echo json_encode($response);
            mysqli_close($conn);

        } else {
            $response["success"] = "0";

            echo json_encode($response);
            mysqli_close($conn);

        }
    } else {
        $result['success'] = "0";
        echo json_encode($result);
        mysqli_close($conn);
    }

}
