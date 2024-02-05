<?php
date_default_timezone_set("Asia/Seoul");
//데이터베이스 정보
$db_host = "localhost";
$db_user = "root";
$db_password = "qwer";
$db_name = "emrs";
$connect = new mysqli($db_host, $db_user, $db_password, $db_name); // 데이터베이스 접속
if ($connect->connect_errno) {
    die('Connection Error : ' . $connect->connect_error); // 오류가 있으면 오류 메세지 출력
}


$ptid = $_POST['ptid'];
$wanjang = $_POST['doctor'];
$reser_time = $_POST['reser_time'];
$reser_date = $_POST['reser_date'];
$ptname = $_POST['ptname'];
$gender = $_POST['gender'];
$pt_state = '1';
//이하 추가된부분
$server_time = $_POST['server_time']; // 프론트엔드에서 전송한 서버 시간 값
$reser_time_input = $_POST['reser_time_input'];

$reser_datetime = new DateTime($reser_time_input, new DateTimeZone('Asia/Seoul'));
$server_datetime = new DateTime($server_time);
$reser_datetime->setTimezone($server_datetime->getTimezone());

// ptid에 따라 pt_table에서 환자 정보 가져오기 
$query = "SELECT ptname, gender FROM pt_table WHERE ptid='$ptid'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
if (!$row) {
    echo "<script>alert('환자 정보가 없습니다.');</script>";
    echo "<script>history.back();</script>";
    exit;
}

$ptname = $row['ptname'];
$gender = $row['gender'];

// pt_reser 테이블에 정보 입력
// $reser_datetime을 문자열로 변환
$reser_datetime_str = $reser_datetime->format("Y-m-d H:i:s");

$query = "INSERT INTO pt_reser (ptid, ptname, gender, wanjang, reser_time, pt_state, reser_date) VALUES('$ptid', '$ptname', '$gender', '$wanjang', '$reser_datetime_str', '$pt_state', '$reser_date')";

$result = mysqli_query($connect, $query);
if (!$result) {
    echo "<script>alert('저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요');</script>";
    echo "<script>history.back();</script>";
    error_log(mysqli_error($connect));
} else {
    echo "<script>alert('정상적으로 예약이 완료되었습니다.');</script>";
    echo "<script>location.href='reser_input.php';</script>";
}
?>