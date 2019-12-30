<?php
include "auth.php";
if ($_SERVER['REQUEST_METHOD']=='POST'){

    require_once "auth.php";

     $token = $_SERVER['HTTP_AUTHORIZATION_TOKEN'];


    $id = $_POST['id'];
    $phone = $_POST['phone'];

    require_once 'conn.php';

    $stmt = $conn->prepare("UPDATE user SET phone=? WHERE id=? ");
    $stmt->bind_param("si",$phone, $id);

    $auth = authorization($id,$token);


    if($auth===1)
    {
            if($stmt->execute()) {
                $result['success']="1";
                echo json_encode($result);
                mysqli_close($conn);
            }
            else {
                $result['success']="0";
                echo json_encode($result);
                mysqli_close($conn);
            }
        }
        else{
            $result['success']="0";
            echo json_encode($result);
            mysqli_close($conn);
        }
        }