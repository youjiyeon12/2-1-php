<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8"> <!-- 문서의 문자 인코딩 설정 -->
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?version=1"> <!-- 공통 CSS 파일 링크 -->
<link rel="stylesheet" type="text/css" href="./css/board.css?version=1"> <!-- 게시판 전용 CSS 파일 링크 -->
	<link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1">
<script>
  function check_input() {
      if (!document.managerboard_form.subject.value) // 제목이 입력되지 않았을 때
      {
          alert("제목을 입력하세요!"); // 알림창 표시
          document.managerboard_form.subject.focus(); // 제목 입력 필드에 포커스 맞춤
          return;
      }
      if (!document.managerboard_form.content.value) // 내용이 입력되지 않았을 때
      {
          alert("내용을 입력하세요!");    // 알림창 표시
          document.managerboard_form.content.focus(); // 내용 입력 필드에 포커스 맞춤
          return;
      }
      document.managerboard_form.submit(); // 제목과 내용이 모두 입력되었으면 폼 전송
   }
</script>
</head>
<body> 
<header>
    <?php include "header.php";?> <!-- 헤더 포함 -->
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
	    		공연 공지 게시판 > 글 쓰기 <!-- 게시판 글 쓰기 제목 -->
		</h3>
	    <form  name="managerboard_form" method="post" action="managerboard_insert.php" enctype="multipart/form-data"> <!-- 글 작성을 위한 폼 -->
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$username?></span> <!-- 사용자 이름 출력 -->
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text"></span> <!-- 제목 입력 필드 -->
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea> <!-- 내용 입력 텍스트 영역 -->
	    			</span>
	    		</li>
	    		<li>
			        <span class="col1"> 첨부 파일</span>
			        <span class="col2"><input type="file" name="upfile"></span> <!-- 파일 첨부 입력 필드 -->
			    </li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">완료</button></li> <!-- 입력 확인 함수 호출 버튼 -->
				<li><button type="button" onclick="location.href='managerboard_list.php'">목록</button></li> <!-- 목록으로 돌아가는 버튼 -->
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
<script src="./js/img_slide.js"></script>
