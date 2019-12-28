<?php

if ($_SERVER['REQUEST_METHOD']=='GET'){

    $userid = $_GET['userId'];
    $status = "active";

    require_once 'conn.php';

    $sql = "SELECT * FROM flat WHERE userId = '$userid' AND status = '$status' ORDER BY date DESC";


    $stmt = $conn->prepare("SELECT * FROM flat WHERE userId = ? AND status = ? ORDER BY date DESC");
    $stmt->bind_param("is",$userid,$status);
    $stmt->execute();

    $result = $stmt->get_result();
    $response = array();
    $response['flat'] = array();


    if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($response['flat'],array(
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
             'photo'    =>$row['photo'],
             'date'    =>$row['date']      
            ));
        }

            

            $response['success']="1";
            echo json_encode($response);
            mysqli_close($conn);
    }     
        else {
            $result['success']="0";
            echo json_encode($response);
            mysqli_close($conn);
        }
    

}