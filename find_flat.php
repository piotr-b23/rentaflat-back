<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
    $status = "active";

    require_once 'conn.php';

    $sql = "SELECT * FROM flat INNER JOIN user ON user.id = flat.userId
    WHERE user.status = ?
    AND flat.status = ?
    AND flat.price BETWEEN ? AND ?
    AND flat.surface BETWEEN ? AND ?
    AND flat.room BETWEEN ? AND ?
    AND flat.type = ?
    AND flat.province = ?
    AND flat.students = ?";

    $types = "ssiiiiiissi";
    $params = array($status, $status, $pricemin, $pricemax, $surfacemin, $surfacemax, $roommin, $roommax, $type, $province, $students);

    if ($locality != "") {
        $sql .= " AND flat.locality = ?";
        $types .= "s";
        array_push($params, $locality);
    }

    if ($street != "") {
        $sql .= " AND flat.street = ?";
        $types .= "s";
        array_push($params, $street);
    }
    $sql .= " ORDER BY flat.date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();

    $result = $stmt->get_result();
    $response = array();
    $response['flat'] = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($response['flat'], array(
                'id' => $row['flatId'],
                'userid' => $row['userId'],
                'description' => $row['description'],
                'price' => $row['price'],
                'surface' => $row['surface'],
                'room' => $row['room'],
                'type' => $row['type'],
                'province' => $row['province'],
                'locality' => $row['locality'],
                'street' => $row['street'],
                'students' => $row['students'],
                'photo' => $row['photo'],
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
