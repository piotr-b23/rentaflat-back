<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $userId = $_GET['userId'];

    require_once 'conn.php';

    $stmt = $conn->prepare("SELECT name FROM user WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();

    if (mysqli_num_rows($result) === 1) {

        if ($row = mysqli_fetch_assoc($result)) {

            $name = $row['name'];

            $response['success'] = "1";
            $response['name'] = $name;
            echo json_encode($response);
            mysqli_close($conn);
        }
    } else {
        $response['success'] = "0";
        echo json_encode($response);
        mysqli_close($conn);
    }
}
