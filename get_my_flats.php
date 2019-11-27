<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $userid = $_POST['userid'];

    require_once 'conn.php';

    $sql = "SELECT * FROM flat WHERE userId = '$userid'";

    $response = mysqli_query($conn, $sql);
    $result = array();
    $result['flat'] = array();


    if(mysqli_num_rows($response)>0){
        while ($row = mysqli_fetch_assoc($response)) {
            array_push($result['flat'],array(
             'id'   =>$row['id'],
             'userid'   =>$row['userId'],   
             'description'  =>$row['description'],   
             'price'    =>$row['price'],      
             'surface'  =>$row['surface'],   
             'room'     =>$row['room'],   
             'type'     =>$row['type'],   
             'province'     =>$row['province'],   
             'locality'     =>$row['locality'],   
             'street'   =>$row['street'],
             'students'     =>$row['students'],   
             'photo'    =>$row['photo']      
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