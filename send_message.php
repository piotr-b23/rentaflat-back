<?php
include "auth.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $token = $_SERVER['HTTP_AUTHORIZATION_TOKEN'];

    $senderId = $_POST['senderId'];
    $recipientId = $_POST['recipientId'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $date = $_POST['date'];


    require_once 'conn.php';

    $stmt = $conn->prepare("INSERT INTO message(senderId, recipientId, title, text,date) VALUES(?,?,?,?,?)");
    $stmt->bind_param("iisss", $senderId, $recipientId, $title, $text, $date);

    $auth = authorization($senderId, $token);

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
