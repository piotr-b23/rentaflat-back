<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $pricemin = $_POST['pricemin'];
    $pricemax = $_POST['pricemax'];

    $surfacemin = $_POST['surfacemin'];
    $surfacemax = $_POST['surfacemax'];

    $roommin = $_POST['roommin'];
    $roommax = $_POST['roommax'];

    $type = $_POST['type'];
    $province = $_POST['province'];
    $locality = $_POST['locality'];
    $street = $_POST['street'];
    $students = $_POST['students'];

    require_once 'conn.php';

    $sql = "SELECT * FROM flat WHERE 
    price BETWEEN '$pricemin' AND '$pricemax' 
    AND surface BETWEEN '$surfacemin' AND '$surfacemax'
    AND room BETWEEN '$roommin' AND '$roommax' 
    AND type = '$type' 
    AND province = '$province'
    AND students = '$students'
    ORDER BY date DESC";

   if($locality != ""){
       $sql .= "AND locality = '$locality'";
   }
    if($street !=""){
        $sql .= "AND street = '$street'";
    }

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
             'photo'    =>$row['photo'],
             'date'    =>$row['date']         
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