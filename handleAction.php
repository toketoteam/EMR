<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db_host = "localhost";
$db_user = "root";
$db_password = "qwer";
$db_name = "emrs";

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name); // 데이터베이스 접속
if ($mysqli->connect_error) {
    die('Connection failed : ' . $mysqli->connect_error); 
}


// JSON 형식의 데이터를 읽습니다.
$inputJSON = file_get_contents('php://input');
$inputData = json_decode($inputJSON, true);

$action = $inputData['action'];

if ($action == "visit") {
    $visitTime = $inputData['visit_time'];
    $id = $inputData['id'];

    if (empty($visitTime)) {
        $visitTime = date("H:i:s");
    }
   
     // pt_state 값을 3으로 업데이트하고, reser_time도 함께 업데이트합니다.
    $stmt = $mysqli->prepare("UPDATE pt_reser SET reser_time = ?, pt_state = 3 WHERE ptid = ?");
    $stmt->bind_param("si", $visitTime, $id);

     if ($stmt->execute()) {
        //이하 추가부분
        $stmt = $mysqli->prepare("SELECT pt_state FROM pt_reser WHERE ptid = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        //이상 추가부분
    echo json_encode(["status" => "success", "visitTime" => $visitTime, "ptState" => $row['pt_state']]);
} else {
        $response = ["status" => "error", "message" => "Could not process visit action"];
        echo json_encode($response);
    }
}

else if($action == "modify"){
    $newTime = $inputData['new_time'];
    $id = $inputData['id'];

    // Prepared statement를 사용하여 SQL 인젝션 방지
    $stmt = $mysqli->prepare("UPDATE pt_reser SET reser_time = ? WHERE ptid = ?");
    $stmt->bind_param("si", $newTime, $id);

    if ($stmt->execute()) {
        //이하참고부분
        $stmt2 = $mysqli->prepare("SELECT reser_time FROM pt_reser WHERE ptid = ?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $result = $stmt2->get_result();
        $row = $result->fetch_assoc();
        //이상참고부분
        $response = ["status" => "success", "newTime" => $newTime];
    } else {
        $response = ["status" => "error", "message" => "Could not update reservation time"];
    }
    echo json_encode($response);
    } 
else if($action == "cancel"){
    $id = $inputData['id'];

    // Prepared statement를 사용하여 pt_reser 테이블에서 해당 예약을 삭제합니다.
    $stmt = $mysqli->prepare("DELETE FROM pt_reser WHERE ptid = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $response = ["status" => "success"];
    } else {
        $response = ["status" => "error", "message" => "Could not cancel the reservation"];
    }
    echo json_encode($response);
}

    else {
    $response = ["status" => "error", "message" => "Unknown action"];
    echo json_encode($response);
}
$mysqli->close();






?>