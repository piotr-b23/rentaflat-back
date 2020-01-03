<?php
include "auth.php";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $token = $_SERVER['HTTP_AUTHORIZATION_TOKEN'];
    $userId = $_GET['userId'];

    require_once 'conn.php';

    $auth = authorization($userId, $token);
    if ($auth === 1) {
        $stmt = $conn->prepare("SELECT message.*, user.name FROM message INNER JOIN user ON message.senderId = user.id WHERE message.recipientId = ? ORDER BY message.date DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        $response = array();
        $response['message'] = array();

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($response['message'], array(
                    'messageId' => $row['id'],
                    'senderId' => $row['senderId'],
                    'recipientId' => $row['recipientId'],
                    'senderName' => $row['name'],
                    'title' => $row['title'],
                    'text' => $row['text'],
                    'date' => $row['date'],
                ));
            }

            $response['success'] = "1";
            echo json_encode($response);
            mysqli_close($conn);
        } else {
            $response['success'] = "0";
            echo json_encode($response);
            mysqli_close($conn);
        }
    } else {
        $result['success'] = "0";
        echo json_encode($result);
        mysqli_close($conn);
    }

}
