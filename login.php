<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once 'conn.php';
    


   // $sql = "SELECT * FROM user WHERE username = '$username'";

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s",$username);
    $stmt->execute();

    $response = $stmt->get_result();
    $result = array();
    $result['login'] = array();

    if(mysqli_num_rows($response)===1){
        $row = mysqli_fetch_assoc($response);

        if (password_verify($password,$row['password'])) {
            $index['name'] = $row['name'];
            $index['username'] = $row['username'];
            $index['id'] = $row['id'];

            array_push($result['login'],$index);

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


}