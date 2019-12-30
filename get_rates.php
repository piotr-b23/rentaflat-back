<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $userId = $_GET['userId'];

    require_once 'conn.php';

    $stmt = $conn->prepare("SELECT * FROM rate WHERE userId = ? ORDER BY date DESC");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    $response = array();
    $response['rate'] = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($response['rate'], array(
                'rateId' => $row['id'],
                'userId' => $row['userId'],
                'raterId' => $row['raterId'],
                'contactRate' => $row['contactRate'],
                'descriptionRate' => $row['descriptionRate'],
                'comment' => $row['comment'],
                'date' => $row['date'],
            ));
        }

        $response['success'] = "1";
        echo json_encode($response);
        mysqli_close($conn);
    } else {
        $response['success'] = "0";
        echo json_encode($response);
        mysqli_close($conn);
    }

}
