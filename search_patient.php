<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "qwer";
$db_name = "emrs";
$connect = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($connect->connect_errno) {
    die('Connection Error : ' . $connect->connect_error);
}

$response = [];

if (isset($_GET['ptid'])) {
    $ptid = $_GET['ptid'];
    $query = "SELECT ptname, gender FROM pt_table WHERE ptid='$ptid'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        $response['success'] = true;
        $response['ptname'] = $row['ptname'];
        $response['gender'] = $row['gender'];
    } else {
        $response['success'] = false;
    }
    
    echo json_encode($response);
} elseif (isset($_GET['ptname'])) {
    $ptname = $_GET['ptname'];
    $query = "SELECT ptid, ptname, TIMESTAMPDIFF(YEAR, birthdate, NOW()) AS age, gender FROM pt_table WHERE ptname LIKE '%$ptname%'";
    $result = mysqli_query($connect, $query);
    
    $patients = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // gender 값을 문자열로 변환
        switch($row['gender']) {
            case 1:
                $row['gender'] = "남자";
                break;
            case 2:
                $row['gender'] = "여자";
                break;
            default:
                $row['gender'] = "그 외";
                break;
        }
        $patients[] = $row;
    }

    echo json_encode($patients);
}
?>
