<?php
 //데이타베이스 정보
 $db_host = "localhost";
 $db_user = "root";
 $db_password = "qwer";
 $db_name = "web_db";
 $connect = new mysqli($db_host, $db_user, $db_password, $db_name); // 데이터베이스 접속
 if ($connect->connect_errno) { die('Connection Error : '.$connect->connect_error); } // 오류가 있으면 오류 메세지 출력



 $id = $_GET['id'];

 if(!$id)
 {
    echo "<script>alert('아이디를 입력하시오');</script>"; 
    echo "<script>history.back();</script>";  
    return;   
 }
 

    //쿼리문 실행
    $query = "select * from member where id='$id'";
    $result = mysqli_query($connect, $query); 
    $row = mysqli_fetch_array($result);

    if($row['id']==null){ // 중복아이디가 없을경우

        echo "<script>alert('아이디 생성가능')</script>";          
        echo "<script>history.back();</script>";  
     
     }else{ // 중복아이디가 있을경우
      
        echo "<script>window.alert('아이디가 존재함');</script>"; 
        echo "<script>history.back();</script>";  
     
     }
?>