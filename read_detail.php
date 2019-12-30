<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];

    require_once 'conn.php';

    $sql = "SELECT * FROM user WHERE id = '$id'";

    $response = mysqli_query($conn, $sql);

    $result = array();
    $result['read'] = array();

    if (mysqli_num_rows($response) === 1) {

        if ($row = mysqli_fetch_assoc($response)) {

            $h['name'] = $row['name'];
            $h['username'] = $row['username'];

            array_push($result['read'], $h);

            $result['success'] = "1";
            $result['message'] = "success";
            echo json_encode($result);
        }
    } else {
        $result['success'] = "0";
        $result['message'] = "error";
        echo json_encode($result);
        mysqli_close($conn);
    }
}
