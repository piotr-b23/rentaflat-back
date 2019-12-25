<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $status = "active";
    

    $password = password_hash ($password, PASSWORD_DEFAULT);

    require_once 'conn.php';

    $sql = "INSERT INTO user(name,username, password, email,status) VALUES('$name','$username','$password','$email','$status')";

    if(mysqli_query($conn, $sql)) {
        $result["success"] = "1";
        $result["message"] = "success";

        echo json_encode($result);
        mysqli_close($conn);

    }else {
        $result["success"] = "0";
        $result["message"] = "error";

        echo json_encode($result);
        mysqli_close($conn);

    }

}