<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8"> <!-- 문서의 문자 인코딩을 설정 -->
<title>PHP 프로그래밍 입문</title> <!-- 웹페이지의 제목 -->
<link rel="stylesheet" type="text/css" href="./css/common.css?version=1"> <!-- 공통 스타일 시트 연결 -->
<link rel="stylesheet" type="text/css" href="./css/board.css?version=1"> <!-- 게시판 스타일 시트 연결 -->
<link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1"><!-- comment -->

<script>
  function check_input() {
      // 제목이 입력되었는지 확인
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요!"); // 알림 표시
          document.board_form.subject.focus(); // 제목 입력란에 포커스 설정
          return;
      }
      // 내용이 입력되었는지 확인
      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!"); // 알림 표시
          document.board_form.content.focus(); // 내용 입력란에 포커스 설정
          return;
      }
      document.board_form.submit(); // 폼 제출
   }
</script> <!-- 자바스크립트 함수 정의 -->
</head>
<body> 
<header>
    <?php include "header.php";?> <!-- 헤더 파일을 포함하여 출력 -->
</header>  
<section>
	<div id="main_img_bar">
        <div id="slider">
            <div class="slide"><img src="./img/nct.jpg"></div>
            <div class="slide"><img src="./img/aespa.jpg"></div>
            <div class="slide"><img src="./img/img7.gif"></div>
            <div class="slide"><img src="./img/black.jpg"></div>
        </div>


    </div>
   	<div id="board_box">
	    <h3 id="board_title">
	    		자유 게시판 > 글 쓰기 <!-- 게시판 제목 표시 -->
		</h3>
	    <form  name="board_form" method="post" action="board_insert.php" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$username?></span> <!-- 사용자 이름 표시 -->
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text"></span> <!-- 제목 입력란 -->
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea> <!-- 내용 입력란 -->
	    			</span>
	    		</li>
	    		<li>
			        <span class="col1"> 첨부 파일</span>
			        <span class="col2"><input type="file" name="upfile"></span> <!-- 파일 첨부 입력란 -->
			    </li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">완료</button></li> <!-- 완료 버튼 -->
				<li><button type="button" onclick="location.href='board_list.php'">목록</button></li> <!-- 목록 버튼 -->
			</ul>
	    </form> <!-- 게시글 작성 폼 -->
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?> <!-- 푸터 파일을 포함하여 출력 -->
</footer>
</body>
</html>
<script src="./js/img_slide.js"></script>
