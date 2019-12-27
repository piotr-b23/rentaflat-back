<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $status = "active";
    

    $password = password_hash ($password, PASSWORD_DEFAULT);

    require_once 'conn.php';
    

    $stmt =$conn->prepare("INSERT INTO user(name,username, password, email,status) VALUES(?,?,?,?,?)");
    $stmt->bind_param("sssss",$name, $username, $password, $email,$status);

    if($stmt->execute()) {
        $response["success"] = "1";

        echo json_encode($response);
        mysqli_close($conn);

    }else {
        $response["success"] = "0";

        echo json_encode($response);
        mysqli_close($conn);

    }

}