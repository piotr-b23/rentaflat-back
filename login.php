<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once 'conn.php';

    $stmt = $conn->prepare("SELECT name,id,password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $response = array();
    $response['login'] = array();

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            $token = bin2hex(openssl_random_pseudo_bytes(64));
            $stmtToken = $conn->prepare("UPDATE user SET authToken=? WHERE id=?");
            $stmtToken->bind_param("si", $token, $row['id']);
            $stmtToken->execute();

            $index['name'] = $row['name'];
            $index['token'] = $token;
            $index['id'] = $row['id'];

            array_push($response['login'], $index);
            $response['success'] = "1";
            echo json_encode($response);
            mysqli_close($conn);
        } else {
            $response['success'] = "0";
            echo json_encode($response);
            mysqli_close($conn);
        }
    }

}
