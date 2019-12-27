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
    $date = $_POST['date'];

    $status = "active";


    require_once 'conn.php';


    $stmt =$conn->prepare("INSERT INTO flat(userId,description, price, surface,room,type,province,locality,street,students,photo,date,status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("isiiissssisss",$userid,$description,$price,$surface,$room,$type,$province,$locality,$street,$students,$photo,$date,$status);



    if($stmt->execute()) {

        $result["success"] = "1";

        echo json_encode($result);
        mysqli_close($conn);
        
    }else {
        $result["success"] = "0";

        echo json_encode($result);
        mysqli_close($conn);

    }

}