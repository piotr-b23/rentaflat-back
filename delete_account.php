<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $password = $_POST['password'];
    $deleted = "deleted";

    require_once 'conn.php';

    $sql = "SELECT * FROM user WHERE id = '$id'";
    $sqle = "UPDATE user SET (name,username, password, email,phone,status) VALUES('$deleted','$deleted','$deleted','$deleted',NULL,'$deleted') ";

    $response = mysqli_query($conn, $sql);

    if (mysqli_num_rows($response) === 1) {
        $row = mysqli_fetch_assoc($response);

        if (password_verify($password, $row['password'])) {
            if (mysqli_query($conn, $sqle)) {
                $result['success'] = "1";
                $result['message'] = "success";
                echo json_encode($result);
                mysqli_close($conn);
            } else {
                $result['success'] = "0";
                $result['message'] = "error";
                echo json_encode($result);
                mysqli_close($conn);
            }
        } else {
            $result['success'] = "0";
            $result['message'] = "error";
            echo json_encode($result);
            mysqli_close($conn);
        }
    }

}
