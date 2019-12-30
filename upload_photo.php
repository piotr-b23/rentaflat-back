<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $photo = $_POST['photo'];
    $path = $_POST['filename'];

    require_once 'conn.php';

    if (file_put_contents($path, base64_decode($photo))) {
        $result["success"] = "1";
        $result["message"] = "success";

        echo json_encode($result);
        mysqli_close($conn);

    } else {
        $result["success"] = "0";
        $result["message"] = "error";

        echo json_encode($result);
        mysqli_close($conn);
    }

}
