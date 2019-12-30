<?php

function authorization($userId,$token){

     require 'conn.php';

     $stmt = $conn->prepare("SELECT * FROM user WHERE id = ? AND authToken = ?");
     $stmt->bind_param("is",$userId,$token);
     $stmt->execute();

    $result = $stmt->get_result();
    $rowsCount = mysqli_num_rows($result);
    mysqli_close($conn);

    return $rowsCount;
}

?>
            