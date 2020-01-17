<?php
include "auth.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $token = $_SERVER['HTTP_AUTHORIZATION_TOKEN'];

    $userId = $_POST['userId'];

    require_once 'conn.php';

    $auth = authorization($userId, $token);

    if ($auth === 1) {

        $result['success'] = "1";
        echo json_encode($result);
        mysqli_close($conn);

    } else {
        $result['success'] = "0";
        echo json_encode($result);
        mysqli_close($conn);
    }
}
