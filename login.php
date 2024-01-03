<? $body = nl2br($body);  ?>

<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- //구글폰트 -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Raleway:400,300,500,700,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		
	<title>제노메드</title>

	<!-- css -->
	<link href="/css/bootstrap.css" rel="stylesheet">		
    <link href="/css/login.css" rel="stylesheet">
</head>

<body>  

<!-- 관리자 로그인 -->
<div class="admin_img"><img src="/images/admin_img.png" alt="" /></div>

<form id="Login" action="login_ok.php" method="post">
<div class="container">
	<dl class="admin_area">
		<div><span>아이디</span> <input type="text" name="id"></div>
		<div><span>비밀번호</span> <input type="password" name="pw"></div>
		<button type="submit" class="admin_login blue web"> 로그인</button> <!-- web -->				
	</dl>
</div>
<div class="container">
	<dl class="admin_area">
		<div><span><a href="join.php"> 회원가입</a></span></div>	
	</dl>
</div>

</form>
<!-- 관리자 로그인 -->

</body>

</html>