<?php

// 환자등록 데이터베이스 정보
$db_host = "localhost";
$db_user = "root";
$db_password = "qwer";
$db_name = "emrs";
$connect = new mysqli($db_host, $db_user, $db_password, $db_name); // 데이터베이스 접속
if ($connect->connect_errno) {
    die('Connection Error : ' . $connect->connect_error); // 오류가 있으면 오류 메세지 출력
}

$ptid = $_POST['ptid'];
$ptname = $_POST['ptname'];
$gender = $_POST['gender'];
$birthdate = $_POST['birthdate'];
$insurance = $_POST['insurances'];

if (!$ptid) {
    echo "<script>alert('환자번호를 입력하시오');</script>";
    echo "<script>history.back();</script>";
}
if (!$ptname) {
    echo "<script>alert('환자이름을 입력하시오');</script>";
    echo "<script>history.back();</script>";
}
if (!$gender) {
    echo "<script>alert('환자성별을 선택하시오');</script>";
    echo "<script>history.back();</script>";
}
if (!$birthdate) {
    echo "<script>alert('생년월일을 입력하시오');</script>";
    echo "<script>history.back();</script>";
}
if (!$insurance) {
    echo "<script>alert('보험 구분을 선택하시오');</script>";
    echo "<script>history.back();</script>";
}

// 쿼리문 실행
$query = "INSERT INTO pt_table (ptid, ptname, gender, birthdate, insurance) VALUES('$ptid', '$ptname', '$gender', '$birthdate', '$insurance')";
$result = mysqli_query($connect, $query);
if ($result != 1) {
    echo "<script>alert('저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요');</script>";
    echo "<script>history.back();</script>";
    error_log(mysqli_error($connect));
} else {
    echo "<script>alert('정상적으로 환자 등록이 완료되었습니다.');</script>";
    echo "<script>location.href='register_patient.php';</script>";
}

?>
