<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $id = $_POST['id'];
    $phone = $_POST['phone'];

    require_once 'conn.php';

    $sql = "SELECT * FROM user WHERE id = '$id'";
    $sqle = "UPDATE user SET phone='$phone' WHERE id='$id' ";

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