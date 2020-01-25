<?php
include "auth.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $token = $_SERVER['HTTP_AUTHORIZATION_TOKEN'];

    $flatId = $_POST['flatId'];
    $reportingUserId = $_POST['reportUserId'];
    $comment = $_POST['comment'];

    date_default_timezone_set('Poland');
    $date = date('Y-m-d H:i:s');

    require_once 'conn.php';

    $stmt = $conn->prepare("INSERT INTO flatreport(flatId,reportingUserId, comment, date) VALUES(?,?,?,?)");
    $stmt->bind_param("isss", $flatId, $reportingUserId, $comment, $date);

    $auth = authorization($reportingUserId, $token);

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
