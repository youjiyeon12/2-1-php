<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8"> <!-- 문자 인코딩 설정 -->
<title>PHP 프로그래밍 입문</title> <!-- 문서 제목 설정 -->
<link rel="stylesheet" type="text/css" href="./css/common.css?"> <!-- 공통 스타일 시트 링크 -->
<link rel="stylesheet" type="text/css" href="./css/login.css?"> <!-- 로그인 관련 스타일 시트 링크 -->
<link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1"> <!-- 이미지 슬라이드 관련 스타일 시트 링크 -->
<script type="text/javascript" src="./js/login.js"></script> <!-- 로그인 관련 자바스크립트 파일 링크 -->
</head>
<body> 
	<header>
    	<?php include "header.php";?> <!-- 헤더 영역에 PHP 파일(header.php)을 포함 -->
    </header>
	<section>
        <div id="main_img_bar"> <!-- 메인 이미지 바 영역 -->
        <div id="slider"> <!-- 슬라이드 영역 -->
            <div class="slide"><img src="./img/nct.jpg"></div> <!-- 각 슬라이드에 이미지 삽입 -->
            <div class="slide"><img src="./img/aespa.jpg"></div>
            <div class="slide"><img src="./img/img7.gif"></div>
            <div class="slide"><img src="./img/black.jpg"></div>
        </div>
        </div>
        <div id="main_content"> <!-- 메인 콘텐츠 영역 -->
      		<div id="login_box"> <!-- 로그인 상자 영역 -->
	    		<div id="login_title"> <!-- 로그인 제목 영역 -->
		    		<span>로그인</span>
	    		</div>
	    		<div id="login_form"> <!-- 로그인 폼 영역 -->
                            <form  name="login_form" method="post" action="login.php"> <!-- 로그인 폼 -->
                                <!-- 로그인 정보 입력을 위한 입력 폼 -->
                  	<ul>
                            <li><input type="text" name="id" placeholder="아이디" ></li> <!-- 아이디 입력란 -->
                    <li><input type="password" id="pass" name="pass" placeholder="비밀번호" ></li> <!-- 비밀번호 입력란 -->
                  	</ul>
                  	<div id="login_btn">
                      	<a href="#"><img src="./img/login.png" onclick="check_input()"></a> <!-- 로그인 버튼 -->
                                <!-- 로그인 버튼 클릭 시 check_input() 함수 실행 -->
                  	</div>		    	
           		</form>
        		</div> <!-- login_form -->
    		</div> <!-- login_box -->
        </div> <!-- main_content -->
	</section> 
	<footer>
    	<?php include "footer.php";?> <!-- 푸터 영역에 PHP 파일(footer.php)을 포함 -->
    </footer>
</body>
</html>
<script src="./js/img_slide.js"></script> <!-- 이미지 슬라이드 관련 자바스크립트 파일 링크 -->
