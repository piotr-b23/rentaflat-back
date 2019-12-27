<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $flatid = $_POST['flatid'];
    $description = $_POST['description'];

    require_once 'conn.php';

    $stmt = $conn->prepare("UPDATE flat SET description= ? WHERE id= ?");

    $stmt->bind_param("si",$description,$flatid);

            if($stmt->execute()) {
                $result['success']="1";
                echo json_encode($result);
                mysqli_close($conn);
            }
            else {
                $result['success']="0";
                echo json_encode($result);
                mysqli_close($conn);
            }


}