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
  







<div id="submenu2_1_container1">

  <div class="sub2_1_con1_wrap">
       <h1></h1>
         <h2>게시글 상세 보기 </h2>


        <!-- 제목-->
         <div class="title_box">
          <h2 > 제목: <?php echo $row['title']?></h2>
         </div>

          
              <div class="add_info_table_lt_view">

                        <table class="add_info_tablewrap_view">

                             <th colspan="2" style="box-sizing:border-box;">상세 내용</th>


                              <tr>
                                  <td colspan="1" class="textarea"><p><?php echo $row['content']?></p>
                                                                 
                                  <br><br>
                                  

                                    

                                  </td>

                              </tr>

                        </table>

          </div>


      


  </div>
    
</div>





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
