<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8"> <!-- 문서의 문자 인코딩을 UTF-8로 설정 -->
<title>PHP 프로그래밍 입문</title> <!-- 문서 제목 설정 -->
<link rel="stylesheet" type="text/css" href="./css/common.css?version=1"> <!-- 공통 CSS 파일 링크 -->
<link rel="stylesheet" type="text/css" href="./css/board.css?version=1"> <!-- 게시판 전용 CSS 파일 링크 -->
	<link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1">
<script>
  function check_input() { // 내용 입력을 확인하는 함수
      if (!document.managerboard_form.subject.value) // 제목이 비어있는 경우
      {
          alert("제목을 입력하세요!"); // 알림창 표시
          document.managerboard_form.subject.focus(); // 제목 입력 필드에 포커스 설정
          return; // 함수 종료
      }
      if (!document.managerboard_form.content.value) // 내용이 비어있는 경우
      {
          alert("내용을 입력하세요!"); // 알림창 표시    
          document.managerboard_form.content.focus(); // 내용 입력 필드에 포커스 설정
          return; // 함수 종료
      }
      document.managerboard_form.submit(); // 입력이 모두 완료되면 폼 제출
   }
</script>
</head>
<body> 
<header>
    <?php include "header.php";?> <!-- 헤더 영역 include -->
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
	    		게시판 > 글 쓰기 <!-- 게시판 제목 -->
		</h3>
<?php
	$num  = $_GET["num"]; // 수정할 글의 번호를 GET 방식으로 받아옴
	$page = $_GET["page"]; // 현재 페이지 번호를 GET 방식으로 받아옴
	
	$con = mysqli_connect("localhost", "user1", "12345", "music"); // MySQL 데이터베이스에 연결
	$sql = "select * from board_manager where num=$num"; // 수정할 글의 정보를 가져오는 SQL 쿼리문
	$result = mysqli_query($con, $sql); // SQL 쿼리 실행하여 결과를 받아옴
	$row = mysqli_fetch_array($result); // 결과를 배열로 가져옴
	$name       = $row["name"]; // 글쓴이 이름
	$subject    = $row["subject"]; // 글 제목
	$content    = $row["content"]; // 글 내용
	$file_name  = $row["file_name"]; // 첨부 파일 이름
?>
	    <form  name="managerboard_form" method="post" action="managerboard_modify.php?num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$name?></span> <!-- 글쓴이 이름 표시 -->
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span> <!-- 제목 입력 필드 -->
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?=$content?></textarea> <!-- 내용 입력 필드 -->
	    			</span>
	    		</li>
	    		<li>
			        <span class="col1"> 첨부 파일 : </span>
			        <span class="col2"><?=$file_name?></span> <!-- 첨부 파일명 표시 -->
			    </li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">수정하기</button></li> <!-- 수정하기 버튼 -->
				<li><button type="button" onclick="location.href='managerboard_list.php'">목록</button></li> <!-- 목록으로 돌아가기 버튼 -->
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?> <!-- 푸터 영역 include -->
</footer>
</body>
</html>
<script src="./js/img_slide.js"></script>