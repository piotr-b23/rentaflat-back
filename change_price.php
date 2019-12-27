<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $flatid = $_POST['flatid'];
    $price = $_POST['price'];

    require_once 'conn.php';

    $sql = "SELECT * FROM flat WHERE id = '$flatid'";
    $sqle = "UPDATE flat SET price='$price' WHERE id='$flatid' ";

    $stmt = $conn->prepare("UPDATE flat SET price= ? WHERE id= ?");

    $stmt->bind_param("ii",$price,$flatid);
        
            if($stmt->execute()) {
                $result['success']="1";
                $result['message']="success";
                echo json_encode($result);
                mysqli_close($conn);
            }
            else {
                $result['success']="0";
                $result['message']="error";
                echo json_encode($result);
                mysqli_close($conn);
            }
    

}