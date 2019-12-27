<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $flatId = $_POST['flatId'];
    $status = 'closed';

    require_once 'conn.php';

    $stmt = $conn->prepare("UPDATE flat SET status= ? WHERE id= ?");
    $stmt->bind_param("si",$status,$flatId);
        
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