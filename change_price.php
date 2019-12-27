<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $flatId = $_POST['flatId'];
    $price = $_POST['price'];

    require_once 'conn.php';

    $stmt = $conn->prepare("UPDATE flat SET price= ? WHERE id= ?");

    $stmt->bind_param("ii",$price,$flatId);
        
            if($stmt->execute()) {
                $response['success']="1";
                echo json_encode($response);
                mysqli_close($conn);
            }
            else {
                $response['success']="0";
                echo json_encode($response);
                mysqli_close($conn);
            }
    

}