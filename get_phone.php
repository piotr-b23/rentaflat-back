<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $userid = $_POST['userid'];

    require_once 'conn.php';

    $sql = "SELECT phone FROM user WHERE id = '$userid'";

    $response = mysqli_query($conn, $sql);

    if(mysqli_num_rows($response)===1){

        if ($row = mysqli_fetch_assoc($response)) {

            $phone = $row['phone'];

            $result['success']="1";
            $result['message']="success";
            $result['phone']=$phone;
            echo json_encode($result);
        }
    }
        else {
            $result['success']="0";
            $result['message']="error";
            echo json_encode($result);
            mysqli_close($conn);
        }
    }