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
    <link href="css/join.css" rel="stylesheet">
</head>

<body>  

<!-- 관리자 로그인 -->
<div class="admin_img"><img src="/images/join_img.png" alt="" /></div>

<div class="container">
		 <div id="">
          <div class="member_list_section">
            
				<div id="mainbody">
						<form method="POST" action="join_ok.php" >
							<table>
							<caption>(*)표시는 <strong>필수입력</strong> 사항입니다.</caption>
								<tr>
									<th><span>*</span>아이디</th>
									<td>
									<div class="id">
										<input type="text" size="20" id='joinId' name="id">
										<input type="button" value="중복체크" onclick="idCheck()">
										<br>
										6~15자의 영문 소문자, 숫자만 가능합니다.
									</div>
									</td>
								</tr>

								<tr>
									<th><span>*</span>비밀번호</th>
									<td>
									<div class="pw">
										<input type="password" size="20" name="pw"><br>
										-<strong>영문자, 숫자, 특수문자</strong>의 조합,<br>
										&emsp;<strong>8자리 이상</strong>으로 이루어져야 합니다.
									</div>
									</td>
								</tr>

								<tr>
									<th><span>*</span>비밀번호 확인</th>
									<td>
									<div class="pw">
										<input type="password" size="20" name="pw_r">
									</div>
									</td>
								</tr>
								<tr>
									<th><span>*</span>이름</th>
									<td>
									<div class="major">
										<input type="text" name="name" value=""> 
										
									</div>
									</td>
								</tr>
								<tr>
									<th><span>*</span>연락처</th>
									<td>
									<div class="major">
										<input type="text" name="hp" value=""> 
										
									</div>
									</td>
								</tr>

								<tr>
									<th>이메일</th>
									<td>
									<div class="email">
										<input type="text" size="15" name="email">
										@
										<select name="email_domain" >
											<option value="1">네이버</option>
											<option value="2">구글</option>
											<option value="3">다음</option>
										</select>
									</div>
									</td>
								</tr>

								<tr>
									<td colspan="2">
									<div>
										&emsp;회원가입을 하시겠습니까?
										<span class="btn">
											<input type="submit" value="가입하기">&nbsp;
										</span>
									</div>
									</td>
								</tr>
							</table>
						</form>

				</div>
		</div>
   	  </div>
      <!-- 게시판영역 종료-->
	</div>
<!-- 관리자 로그인 -->

</body>
<script type="text/javascript">
    function idCheck() {
		var id = document.getElementById('joinId').value;		
		location.href="join_id_check.php?id="+id;
    //alert('아이디: '+id);
    }  
</script>


</html>