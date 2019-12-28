<?php

if ($_SERVER['REQUEST_METHOD']=='GET'){

    $userId = $_GET['userId'];
    $raterId = $_GET['raterId'];

    require_once 'conn.php';

    $stmt =$conn->prepare("SELECT * FROM rate WHERE userId = ? AND raterId = ?");
    $stmt->bind_param("ii",$userId, $raterId);
    $stmt->execute();

    $result = $stmt->get_result();


    if($userId != $raterId){

    

    if(mysqli_num_rows($result)>0){
        
        $response['success']="0";
        $response['message']="rated";
        echo json_encode($response);
        mysqli_close($conn);

    }
            else {
                $response['success']="1";
                $response['message']="not rated";
                echo json_encode($response);
                mysqli_close($conn);
            }

}
else{
    $response['success']="0";
    $response['message']="same user";
    echo json_encode($response);
    mysqli_close($conn);
}
}