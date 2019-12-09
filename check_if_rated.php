<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $userid = $_POST['userid'];
    $raterid = $_POST['raterid'];

    require_once 'conn.php';

    $sql = "SELECT * FROM rate WHERE userId = '$userid' AND raterId = '$raterid'";

    $response = mysqli_query($conn, $sql);


    if(mysqli_num_rows($response)===0){
        
                $result['success']="1";
                $result['message']="not rated";
                echo json_encode($result);
                mysqli_close($conn);
    }
            else {
                $result['success']="0";
                $result['message']="rated";
                echo json_encode($result);
                mysqli_close($conn);
            }
    

}