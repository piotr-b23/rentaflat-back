<?php
include "auth.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $token = $_SERVER['HTTP_AUTHORIZATION_TOKEN'];

    $rateId = $_POST['rateId'];
    $reportingUserId = $_POST['reportingUserId'];
    $comment = $_POST['comment'];

    date_default_timezone_set('Poland');
    $date = date('Y-m-d H:i:s');

    require_once 'conn.php';

    $stmt = $conn->prepare("INSERT INTO ratereport(rateId,reportingUserId, comment, date) VALUES(?,?,?,?)");
    $stmt->bind_param("isss", $rateId, $reportingUserId, $comment, $date);

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
