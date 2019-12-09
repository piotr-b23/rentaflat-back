<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $userid = $_POST['userid'];

    require_once 'conn.php';

    $sql = "SELECT * FROM rate WHERE userId = '$userid' ORDER BY date DESC";

    $response = mysqli_query($conn, $sql);
    $result = array();
    $result['rate'] = array();


    if(mysqli_num_rows($response)>0){
        while ($row = mysqli_fetch_assoc($response)) {
            array_push($result['rate'],array(
             'rateId'   =>$row['id'],   
             'userId'   =>$row['userId'],   
             'raterId'  =>$row['raterId'],   
             'contactRate'    =>$row['contactRate'],      
             'descriptionRate'  =>$row['descriptionRate'],   
             'comment'     =>$row['comment'],   
             'date'     =>$row['date']   
            ));
        }
            

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