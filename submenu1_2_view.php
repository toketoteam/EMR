<?php
 //데이타베이스 정보
 $db_host = "localhost";
 $db_user = "root";
 $db_password = "qwer";
 $db_name = "web_db";
 $connect = new mysqli($db_host, $db_user, $db_password, $db_name); // 데이터베이스 접속
 if ($connect->connect_errno) { die('Connection Error : '.$connect->connect_error); } // 오류가 있으면 오류 메세지 출력

 $idx = $_GET['idx'];

 $select_query = "select * FROM board where idx = '$idx'";        
 $result = $connect->query($select_query);
 while($row = $result->fetch_assoc())
 {
    $title = $row['title'];    
    $writer = $row['writer'];  
    $content = $row['content']; 
     // 날짜 포맷 
     $regdate = $row['reg_date'];
     $date = date_create($regdate);
     $_date = date_format($date, "Y.m.d");
 }
?>


<!DOCTYPE html>
<html lang="ko">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- //구글폰트 -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Raleway:400,300,500,700,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" type="text/css">
    	<!--<meta name="description" content="">
    <meta name="author" content="">-->
    <title>Genomed</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/reset_responsive.css" rel="stylesheet">
    <link href="css/submenu1_2.css" rel="stylesheet">
    <link href="css/board.css" rel="stylesheet">
    <!--<link href="css/modern-business.css" rel="stylesheet">-->
   <!-- <link href="css/index_responsive2.css" rel="stylesheet">-->

  </head>
  <body>

<!-- 헤더 검색바 -->
<div clas="top_submenu_wrap" style="background:#fff;">
    <div class="container">
      <dlv class="row">
          <div class="hd1_line col-md-12 col-sm-12">
               <input type="text" placeholder="검색어를 입력하세요." name="" class="search_box">
                 <span class="search_icon"><i class="fa fa-search"></i></span>
                 <a href="index.html" class="search_icon2"><i class="fa fa-home"></i></a>
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
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    회사소개
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                    <a class="dropdown-item" href="submenu1.html">회사소개</a>
                    <a class="dropdown-item" href="submenu1_2.html">공지사항</a>
                    <a class="dropdown-item" href="submenu1_3.html">Q&amp;A</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="submenu2.html" style="">Solgent</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="submenu2.html" style="">GVS</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="submenu2.html"  style="">Axygen</a>
                 </li>
                <li class="nav-item">
                  <a class="nav-link" href="submenu2.html"  style="">SPL</a>
                 </li>
                  <li class="nav-item">
                  <a class="nav-link" href="submenu2.html"  style="">BD</a>
                 </li>
                
              </ul>
            </div>

      </div>
    </nav>
<!--//네비게이션 종료-->



<!-- 공지사항-->
<div class="submenu1_2_section1">
	<div class="container">
            <div class="row">
                <div class="sub_topbanner col-md-12">
                    <h2></h2>
                    <p>게시판 내용</p>
                </div>
                			    
          </div>
	</div>
</div>




<!-- 게시판-->
<div class="submenu1_2_section3">
	<div class="container">
		
		
    <div id="submenu2_1_container1">

<div class="sub2_1_con1_wrap">
     <h1></h1>
       <h2>게시글 상세 보기 </h2>


      <!-- 제목-->
       <div class="title_box">
        <h2 > 제    목: <?=$title?></h2>
        <h2 > 등록일자: <?=$_date?></h2>
        <h2 > 작 성 자: <?=$writer?></h2>
       </div>

        
            <div class="add_info_table_lt_view">

                      <table class="add_info_tablewrap_view">

                           <th colspan="2" style="box-sizing:border-box;">상세 내용</th>


                            <tr>
                                <td colspan="1" class="textarea"><p><?=$content?></p>
                                                               
                                <br><br>
                                

                                  

                                </td>

                            </tr>

                      </table>

        </div>


    


</div>
  
</div>
      <!-- 게시판영역 종료-->
	
	</div>
</div>



<!-- 풋터 -->
<div class="main_footer">
  <div class="container">
        <div id="ft">
          <div class="ft_line">
              <div class="ft_002">
                  <img src="images/footer_logo.png" alt="logo" style="width:auto; ">
              </div>
              <div class="ft_003">
                  <ul><a href="#">회사소개</a>
                  </ul>
                  <ul><a href="#">제품소개</a>   
                  </ul>
                  <ul><a href="#">이용약관</a>  
                  </ul>
                  
                  <p><span>대표이사 :</span> &nbsp;김준이 &nbsp;&nbsp;&nbsp;<span>사업자등록번호</span> : &nbsp;107 - 00 - 00000 </p>
                  <p><span>[본사] &nbsp;</span>대전, 충북 : 대전광역시 유성구 원신흥남로 42번길 25 101호(원신흥동)&nbsp;&nbsp;
                   TEL) 070-4142-6021 &nbsp;&nbsp;FAX) 042-484-6021</p>
                  <p><span>[서울지점] &nbsp;</span>서울,경기 : 서울특별시 금천구 서부샛길 534 세계일보4층 424호(가산동)&nbsp;&nbsp;
                   TEL) 070-4142-6021 &nbsp;&nbsp;FAX) 02-857-6021</p>
                  
              </div>
              
          </div>
      </div>
  </div>
</div>

<!-- 하단 맨 끝 -->
<div class="main_footer_2">
    <div class="container-fluid" style="">
        <div class="row">
              <div class="ft_005">
                    <p>Copyright © Genomed. All right reserved.</p>
                </div>
        </div>
    </div>
</div>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>

</html>
