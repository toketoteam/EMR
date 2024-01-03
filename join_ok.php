<?php
 //데이타베이스 정보
 $db_host = "localhost";
 $db_user = "root";
 $db_password = "qwer";
 $db_name = "web_db";
 $connect = new mysqli($db_host, $db_user, $db_password, $db_name); // 데이터베이스 접속
 if ($connect->connect_errno) { die('Connection Error : '.$connect->connect_error); } // 오류가 있으면 오류 메세지 출력



 $id = $_POST['id'];
 $pw = $_POST['pw'];
 $pw_r = $_POST['pw_r'];
 $name = $_POST['name'];
 $hp = $_POST['hp'];
 $email = $_POST['email'];
 $email_domain = $_POST['email_domain'];

 if(!$id)
 {
    echo "<script>alert('아이디를 입력하시오');</script>"; 
    echo "<script>history.back();</script>";     
 }
 if(!$pw || !$pw_r)
 {
    echo "<script>alert('패스워드를 입력하시오');</script>"; 
    echo "<script>history.back();</script>";     
 }
 if($pw != $pw_r)
 {
    echo "<script>alert('패스워드와 확인이 일치하지않습니다.');</script>"; 
    echo "<script>history.back();</script>";  
 }
 if(!$name)
 {
    echo "<script>alert('아이디를 입력하시오');</script>"; 
    echo "<script>history.back();</script>";     
 }
 if(!$hp)
 {
    echo "<script>alert('아이디를 입력하시오');</script>"; 
    echo "<script>history.back();</script>";     
 }
 $temp ="";
 if($email_domain==1){ $temp="@naver.com"; }
 else if($email_domain==2){ $temp="@gmail.com"; }
 else if($email_domain==3){ $temp="@daum.net"; } 
 $email = $email.$temp;

    //쿼리문 실행
    $query = "INSERT INTO member
    (id, pw, name, hp, email) VALUES('$id','$pw','$name', '$hp', '$email')";
    $result = mysqli_query($connect, $query);     
    if($result != 1)
    {
        echo "<script>alert('저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요');</script>"; 
        //echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
        echo "<script>history.back();</script>";   
        error_log(mysqli_error($connect));
    }else{
        //echo '성공했습니다. <a href="login.php">로그인하기..</a>';
        echo "<script>alert('정상적으로 회원가입 완료!!');</script>"; 
        echo "<script>location.href='login.php';</script>";
    }
    


//  echo '아이디:'.$id.'</br>';
//  echo '패스워드:'.$pw.'</br>';
//  echo '패스워드확인:'.$pw_r.'</br>';
//  echo '이름:'.$name.'</br>';
//  echo '연락처:'.$hp.'</br>';
//  echo '이메일:'.$email.'</br>';
//  echo '이메일@:'.$email_domain.'</br>';
?>