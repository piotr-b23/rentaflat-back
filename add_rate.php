<?php
include "auth.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $token = $_SERVER['HTTP_AUTHORIZATION_TOKEN'];

    $userId = $_POST['userId'];
    $raterId = $_POST['raterId'];
    $contactRate = $_POST['contactRate'];
    $descriptionRate = $_POST['descriptionRate'];
    $comment = $_POST['comment'];

    date_default_timezone_set('Poland');
    $date = date('Y-m-d');

    require_once 'conn.php';

    $stmt = $conn->prepare("INSERT INTO rate(userId,raterId, contactRate, descriptionRate, comment, date) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("ssddss", $userId, $raterId, $contactRate, $descriptionRate, $comment, $date);

    $auth = authorization($raterId, $token);

    if ($auth === 1) {
        if ($raterId != $userId) {
            if ($stmt->execute()) {

                $response["success"] = "1";
                $response["message"] = "success";
                echo json_encode($response);
                mysqli_close($conn);

            } else {
                $response["success"] = "0";
                $response["message"] = "error";

                echo json_encode($response);
                mysqli_close($conn);

            }
        } else {
            $response["success"] = "0";
            $response["message"] = "same user";

            echo json_encode($response);
            mysqli_close($conn);
        }} else {
        $result['success'] = "0";
        echo json_encode($result);
        mysqli_close($conn);
    }

}
