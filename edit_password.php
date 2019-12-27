<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $id = $_POST['id'];
    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];

    $newpassword = password_hash ($newpassword, PASSWORD_DEFAULT);

    require_once 'conn.php';

    $stmt = $conn->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->bind_param("i",$id);
    $stmt->execute();

    $result = $stmt->get_result();

    $stmtUpdatePass = $conn->prepare("UPDATE user SET password=? WHERE id=?");
    $stmtUpdatePass->bind_param("si",$newpassword,$id);


    if(mysqli_num_rows($result)===1){
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password,$row['password'])) {
            if($stmtUpdatePass->execute()) {
                $response['success']="1";
                $response['message']="success";
                echo json_encode($response);
                mysqli_close($conn);
            }
            else {
                $response['success']="0";
                $response['message']="error";
                echo json_encode($response);
                mysqli_close($conn);
            }
        }
        else {
            $response['success']="0";
            $response['message']="password";
            echo json_encode($response);
            mysqli_close($conn);
        }
    }


}