<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $userid = $_POST['userid'];
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
    
    $path = "user_data/$userid.jpeg";
    $finalPath = "http://192.168.1.13/".$path;

    require_once 'conn.php';

    $sql = "INSERT INTO flat(userId,description, price, surface,room,type,province,locality,street,students,photo) VALUES('$userid','$description','$price','$surface','$room','$type','$province','$locality','$street','$students','$finalPath')";

    if(mysqli_query($conn, $sql)) {

        if( file_put_contents($path,base64_decode($photo))) {
            $result["success"] = "1";
            $result["message"] = "success";
    
            echo json_encode($result);
            mysqli_close($conn);

        }

        

        

    }else {
        $result["success"] = "0";
        $result["message"] = "error";

        echo json_encode($result);
        mysqli_close($conn);

    }

}