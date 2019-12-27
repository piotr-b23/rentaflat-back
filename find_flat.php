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


   if($locality != "" && $street !=""){
    $stmt = $conn->prepare("SELECT * FROM flat WHERE 
    price BETWEEN ? AND ? 
    AND surface BETWEEN ? AND ?
    AND room BETWEEN ? AND ? 
    AND type = ? 
    AND province = ?
    AND locality = ?
    AND street = ?
    AND students = ?
    ORDER BY date DESC");
    $stmt->bind_param("iiiiiissssi",$pricemin,$pricemax,$surfacemin,$surfacemax,$roommin,$roommax,$type,$province,$locality,$street,$students);
   }
   else if($locality != ""){
    $stmt = $conn->prepare("SELECT * FROM flat WHERE 
    price BETWEEN ? AND ? 
    AND surface BETWEEN ? AND ?
    AND room BETWEEN ? AND ? 
    AND type = ? 
    AND province = ?
    AND locality = ?
    AND students = ?
    ORDER BY date DESC");
    $stmt->bind_param("iiiiiisssi",$pricemin,$pricemax,$surfacemin,$surfacemax,$roommin,$roommax,$type,$province,$locality,$students);
   }
    else if($street !=""){
        $stmt = $conn->prepare("SELECT * FROM flat WHERE 
        price BETWEEN ? AND ? 
        AND surface BETWEEN ? AND ?
        AND room BETWEEN ? AND ? 
        AND type = ? 
        AND province = ?
        AND street = ?
        AND students = ?
        ORDER BY date DESC");
        $stmt->bind_param("iiiiiisssi",$pricemin,$pricemax,$surfacemin,$surfacemax,$roommin,$roommax,$type,$province,$street,$students);
    }
    else {
        $stmt = $conn->prepare("SELECT * FROM flat WHERE 
        price BETWEEN ? AND ? 
        AND surface BETWEEN ? AND ?
        AND room BETWEEN ? AND ? 
        AND type = ? 
        AND province = ?
        AND students = ?
        ORDER BY date DESC");
        $stmt->bind_param("iiiiiissi",$pricemin,$pricemax,$surfacemin,$surfacemax,$roommin,$roommax,$type,$province,$students);
    }


    
    $stmt->execute();

    $response = $stmt->get_result();
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