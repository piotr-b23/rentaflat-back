<?php
include "auth.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $token = $_SERVER['HTTP_AUTHORIZATION_TOKEN'];

    $userId = $_POST['userId'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    require_once 'conn.php';

    $stmtUpdateMail = $conn->prepare("UPDATE user SET email=? WHERE id=?");
    $stmtUpdateMail->bind_param("ss", $email, $userId);

    $auth = authorization($userId, $token);

    if ($auth === 1) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $stmtExistingMail = $conn->prepare("SELECT id FROM user WHERE email = ?");
            $stmtExistingMail->bind_param("s", $email);
            $stmtExistingMail->execute();
            $checkIfMailExists = $stmtExistingMail->get_result();

            if (mysqli_num_rows($checkIfMailExists) === 0) {

                $stmt = $conn->prepare("SELECT password FROM user WHERE id = ?");
                $stmt->bind_param("i", $userId);
                $stmt->execute();

                $result = $stmt->get_result();

                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);

                    if (password_verify($password, $row['password'])) {
                        if ($stmtUpdateMail->execute()) {
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
                        $response['message'] = "password";
                        echo json_encode($response);
                        mysqli_close($conn);
                    }
                }
            } else {
                $response['success'] = "0";
                $response['message'] = "mail";
                echo json_encode($response);
                mysqli_close($conn);
            }
        } else {
            $result['success'] = "0";
            echo json_encode($result);
            mysqli_close($conn);
        }
    } else {
        $result['success'] = "0";
        echo json_encode($result);
        mysqli_close($conn);
    }

}
