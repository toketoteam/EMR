<?php
    $con = mysqli_connect("localhost", "root", "qwer", "php_db");
    mysqli_query($con,'SET NAMES utf8');
	//세션 데이터에 접근하기 위해 세션 시작
	if (!session_id()) {
		session_start();
	}


	if($_SESSION['id_check'] !=true)
	{
		echo "<script>alert('중복체크부터 실행하시오.');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}
    $id = $_POST['id'];
    $pw = $_POST['pw'];
	$pw_r = $_POST['pw_r'];

	if(!$id)
	{
		echo "<script>alert('아이디를 입력하시오');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}
	if(!$pw)
	{
		echo "<script>alert('비밀번호를 입력하시오');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}
	if(!$pw_r)
	{
		echo "<script>alert('비밀번호확인을 입력하시오');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}
	if($pw !=$pw_r)
	{
		echo "<script>alert('비밀번호가 서로 다릅니다!');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}


    $name = $_POST['name'];
    $hp = $_POST['hp'];
    $email = $_POST['email'];
	$email_domain = $_POST['email_domain'];

	if(!$name)
	{
		echo "<script>alert('이름을 입력하시오');</script>"; 
		echo("<script>history.back();</script>");
		return; 
	}
	if(!$hp)
	{
		echo "<script>alert('연락처를 입력하시오');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}
	if(!$email)
	{
		echo "<script>alert('이메일을 입력하시오');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}
	if($email_domain==1)
	{
		$email = $email."@naver.com";
	}
	else if($email_domain==2)
	{
		$email = $email."@google.com";
	}
	else if($email_domain==3)
	{
		$email = $email."@daum.com";
	}
	
	
    $statement = mysqli_prepare($con, "INSERT INTO member VALUES (null,?,?,?,?,?)");
    mysqli_stmt_bind_param($statement, "sssss", $id, $pw, $name, $hp,$email);
    mysqli_stmt_execute($statement);

    echo "<script>alert('회원가입완료!');</script>"; 
    echo("<script>location.href='./member_join.php';</script>"); 
?> 

