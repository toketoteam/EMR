<?php
    $con = mysqli_connect("localhost", "root", "qwer", "php_db");
    mysqli_query($con,'SET NAMES utf8');	
	
//세션 데이터에 접근하기 위해 세션 시작
if (!session_id()) {
	session_start();
  }


  $idx = $_GET['idx'];                                             
  $sql = "select * from board where idx ='$idx'"; 
  $result = mysqli_query($con, $sql); 
  $row = mysqli_fetch_array($result);  

?>



<!DOCTYPE html>
<html lang="ko">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- //구글폰트 -->
 

    <title>회원관리 사이트</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">	
    <!-- Custom styles for this template -->	
    <link href="css/reset_responsive.css" rel="stylesheet">    
	<link href="css/style.css" rel="stylesheet">
    <link href="css/board.css" rel="stylesheet">
	<link href="css/submenu2.css" rel="stylesheet">
	<link href="css/border.css" rel="stylesheet">
	<!--   -->
  </head>
  <body>


<!--타이틀자리 -->
<div class="main_footer_2">
    <div class="container-fluid" style="">
        <div class="row">
              <div class="ft_005">
                    <H2><p>게시판</p></H2>
                </div>
        </div>
    </div>
</div>


<!-- 헤더 네비게이션 -->
	 <nav class="navbar navbar-expand-lg navbar-dark" style="background:#005b91; color:#fff;">
      <div class="container">
          <a class="navbar-brand" href="#"></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

            <div class="collapse navbar-collapse text-center" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">

                <li class="nav-item">
				<?php
                  if($_SESSION['login_check']==true)
                  {
                  ?>				
                        <a class="nav-link" href="index_login.php" style="">HOME</a>
                  <?php                 
                  }else
				  {
                  ?>
						<a class="nav-link" href="index.html" style="">HOME</a>
				  <?php                 
                  }
                  ?>
                </li>
				<li class="nav-item">
                  <a class="nav-link" href="member_list.php" style="">회원목록</a>
                </li>

				<?php
                  if($_SESSION['login_check']==true)
                  {
                  ?>				
                          <li class="nav-item">
                            <a class="nav-link" href="member_info.php" style="">회원정보</a>
                          </li>
                  <?php                 
                  }
                  ?>
				<li class="nav-item">
                  <a class="nav-link" href="board.php" style="">게시판</a>
                </li>
				<li class="nav-item">
                  <a class="nav-link" href="member_join.php" style="">회원가입</a>
                </li>
                 <li class="nav-item">
				 <?php
                  if($_SESSION['login_check']==true)
                  {
                  ?>				
                       <a class="nav-link" href="member_logout.php"  style="">로그아웃</a>
                  <?php                 
                  }else
				  {
                  ?>
						<a class="nav-link" href="member_login.php"  style="">로그인</a>
				  <?php                 
                  }
                  ?>
                  
                 </li>                
                
              </ul>
            </div>

      </div>
    </nav>
<!--//네비게이션 종료-->
  







<!-- 본문 -->
<div class="container">	
	


	
	<!-- 게시판 쓰기 -->
	
	<form action="writeDo.php" enctype="multipart/form-data" method="post">
	
	<div id="board_write">
		<table>
			<colgroup>
				<col width="20%">
				<col>
			</colgroup>

			 
			<tbody>
				<tr>
					<th>작성자</th>					
					<td><input type="text" name="name" class="form-control" value="" detect="" detect-check="true"></td>
					
				</tr>
				
				
				
				<tr>
					<th>제목</th>
					<?php if($answer==1) { ?>
					<td><input type="text" name="subject" id="subject" class="form-control" value="ㄴ[ <?=$subject?> ]의 답변" detect="" detect-check="true"></td>
					<?php } else { ?>
					<td><input type="text" name="subject" id="subject" class="form-control" value="" detect="" detect-check="true"></td>
					<?php } ?>	
				</tr>
				<tr>
					
					<td colspan="2" class="editor"><textarea name="contents" rows="20" title="내용"></textarea></td>
					
				</tr>
				
				
				<tr>
					<th>첨부파일</th>
					<td>
						<div class="file_box">
							<input type="text" class="file_name" readonly="readonly"></input>
							<label for="uploadBtn" class="btn_file">찾아보기</label>
							<input type="file" id="uploadBtn" value="1" name="b_file" class="uploadBtn"></input>
							
						</div>
					</td>
				</tr>				
				
			</tbody>
		
		</table>
	</div>
	<!-- //게시판 쓰기 -->

	<!-- 게시판 버튼 -->
	<div class="border_btn2">
		<button type="submit" class="btn blue" > 확인 </button> 
		<button type="button" class="btn gray" onclick="location.href='/border/border_list.php'; return false;"> 취소 </button> 

	</div>
	<!-- //게시판 버튼 -->
	<input type="hidden" name="page" value="<?=$page_name?>" />
	<input type="hidden" name="answer" value="<?=$answer?>" />
	<? if($answer==1) { ?>
	<input type="hidden" name="idx" value="<?=$idx?>" />
	<?}?>
	</form>
	
</div>
<!-- //본문 -->





<!-- 하단 맨 끝 -->
<div class="main_footer_2">
    <div class="container-fluid" style="">
        <div class="row">
              <div class="ft_005">
                    <p>프로그래머 초보 홍길동</p>
                </div>
        </div>
    </div>
</div>







  </body>

</html>
