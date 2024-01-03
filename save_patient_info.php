<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "qwer";
$db_name = "emrs";

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($mysqli->connect_error) {
    die('Connection failed : ' . $mysqli->connect_error);
}

$ptid = $_POST['ptid'];
$ptname = $_POST['ptname'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$birthdate = $_POST['birthdate'];
$gender = $_POST['gender'];
$insurance = $_POST['insurance'];

// 여기서는 UPDATE로 구현했습니다. ptid가 기존에 존재한다고 가정하였습니다.
$query = "UPDATE pt_table SET ptname=?, contact=?, address=?, birthdate=?, gender=?, insurance=? WHERE ptid=?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('sssssss', $ptname, $contact, $address, $birthdate, $gender, $insurance, $ptid);

if($stmt->execute()) {
    $response = ['status' => 'success'];
} else {
    $response = ['status' => 'error'];
}

echo json_encode($response);

$stmt->close();
$mysqli->close();
?>
