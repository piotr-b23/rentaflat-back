<?php
include "auth.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $token = $_SERVER['HTTP_AUTHORIZATION_TOKEN'];

    $userId = $_POST['userId'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $surface = $_POST['surface'];
    $room = $_POST['room'];
    $type = $_POST['type'];
    $province = $_POST['province'];
    $locality = $_POST['locality'];
    $street = $_POST['street'];
    $students = $_POST['students'];
    $photo = $_POST['photo'];

    date_default_timezone_set('Poland');
    $date = date('Y-m-d H:i:s');

    $status = "active";

    require_once 'conn.php';

    $stmt = $conn->prepare("INSERT INTO flat(userId,description, price, surface,room,type,province,locality,street,students,photo,date,status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssiiissssisss", $userId, $description, $price, $surface, $room, $type, $province, $locality, $street, $students, $photo, $date, $status);

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
