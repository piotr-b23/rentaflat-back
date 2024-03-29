<?php
include "auth.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $token = $_SERVER['HTTP_AUTHORIZATION_TOKEN'];

    $flatId = $_POST['flatId'];
    $status = 'closed';
    $userId = $_POST['userId'];

    require_once 'conn.php';

    $stmt = $conn->prepare("UPDATE flat SET status= ? WHERE flatId= ? and userId = ?");
    $stmt->bind_param("sis", $status, $flatId, $userId);

    $auth = authorization($userId, $token);

    if ($auth === 1) {

        if ($stmt->execute()) {
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
