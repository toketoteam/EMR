<?php

//데이터베이스 정보
$db_host = "localhost";
$db_user = "root";
$db_password = "qwer";
$db_name = "emrs";
$connect = new mysqli($db_host, $db_user, $db_password, $db_name); // 데이터베이스 접속
if ($connect->connect_errno) {
    die('Connection Error : ' . $connect->connect_error); // 오류가 있으면 오류 메세지 출력
}


$ptid = '1234570';
$wanjang = '김원장';
$reser_time = '21:00';
$ptname = '한혜지';
$gender = '2';
$pt_state = '1';

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
$query = "INSERT INTO pt_reser (ptid, ptname, gender, wanjang, reser_time, pt_state) VALUES('$ptid', '$ptname', '$gender', '$wanjang', '$reser_time', '$pt_state')";
$result = mysqli_query($connect, $query);
if (!$result) {
    echo "<script>alert('저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요');</script>";
    echo "<script>history.back();</script>";
    error_log(mysqli_error($connect));
} else {
    echo "<script>alert('정상적으로 예약이 완료되었습니다.');</script>";
    echo "<script>location.href='register_patient.php';</script>";
}
?>