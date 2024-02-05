<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "qwer";
$db_name = "emrs";

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name); // 데이터베이스 접속
if ($mysqli->connect_error) {
    die('Connection failed : ' . $mysqli->connect_error); 
}

$ptid = $_POST['ptid'];

$query = "SELECT * FROM pt_table WHERE ptid='$ptid'";
$result = mysqli_query($mysqli, $query);

if($row = mysqli_fetch_assoc($result)) {
    $response = [
        'status' => 'success',
        'ptid' => $row['ptid'],
        'ptname' => $row['ptname'],
        'contact' => $row['contact'],
        'address' => $row['address'],
        'birthdate' => $row['birthdate'],
        'gender' => $row['gender'],        // 성별 데이터 추가
        'insurance' => $row['insurance']   // 보험 데이터 추가
    ];
} else {
    $response = [
        'status' => 'error'
    ];
}

echo json_encode($response);

$mysqli->close(); // 연결 종료
?>
