<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $flatid = $_POST['flatid'];
    $price = $_POST['price'];

    require_once 'conn.php';

    $sql = "SELECT * FROM flat WHERE id = '$flatid'";
    $sqle = "UPDATE flat SET price='$price' WHERE id='$flatid' ";

    $response = mysqli_query($conn, $sql);

    if(mysqli_num_rows($response)===1){
        $row = mysqli_fetch_assoc($response);
        
            if(mysqli_query($conn, $sqle)) {
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


}