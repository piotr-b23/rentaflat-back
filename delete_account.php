<?php
include "auth.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $token = $_SERVER['HTTP_AUTHORIZATION_TOKEN'];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $userId = $_POST['userId'];
    $null = null;
    $status = "deleted";

    require_once 'conn.php';

    $auth = authorization($userId, $token);
    if ($auth === 1) {

        $stmt = $conn->prepare("SELECT password FROM user WHERE username = ? AND id = ?");
        $stmt->bind_param("si", $username, $userId);
        $stmt->execute();

        $result = $stmt->get_result();

        $stmtDeleteUser = $conn->prepare("UPDATE user SET name = ?,username= ?, password= ?, email= ?,phone= ?,status= ?, authToken = ? WHERE username = ? AND id = ?");
        $stmtDeleteUser->bind_param("ssssisssi", $null, $null, $null, $null, $null, $status,$null,$username, $userId);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row['password'])) {
                if ($stmtDeleteUser->execute()) {
                    $response['success'] = "1";
                    $response['message'] = "success";
                    echo json_encode($response);
                    mysqli_close($conn);
                } else {
                    $response['success'] = "0";
                    $response['message'] = "error";
                    echo json_encode($response);
                    mysqli_close($conn);
                }
            } else {
                $response['success'] = "0";
                $response['message'] = "error";
                echo json_encode($response);
                mysqli_close($conn);
            }
        } else {
            $response['success'] = "0";
            $response['message'] = "error";
            echo json_encode($response);
            mysqli_close($conn);
        }
    }

}
