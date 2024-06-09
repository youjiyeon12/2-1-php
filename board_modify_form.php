<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8"> <!-- 문서의 문자 인코딩 설정 -->
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?"> <!-- 공통 CSS 파일 링크 -->
<link rel="stylesheet" type="text/css" href="./css/board.css?"> <!-- 게시판 전용 CSS 파일 링크 -->
    <link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1">
<script>
  function check_input() { // 내용 입력을 했는지 확인하는 함수
      if (!document.board_form.subject.value) // 제목이 입력되지 않았을 때
      {
          alert("제목을 입력하세요!"); // 알림창 표시
          document.board_form.subject.focus(); // 제목 입력 필드에 포커스 맞춤
          return;
      }
      if (!document.board_form.content.value) // 내용이 입력되지 않았을 때
      {
          alert("내용을 입력하세요!");    // 알림창 표시
          document.board_form.content.focus(); // 내용 입력 필드에 포커스 맞춤
          return;
      }
      document.board_form.submit(); // 제목과 내용이 모두 입력되었으면 폼 전송
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
	    		게시판 > 글 쓰기 <!-- 게시판 글 쓰기 제목 -->
		</h3>
<?php
	$num  = $_GET["num"]; // GET 방식으로 넘어온 글 번호 가져오기
	$page = $_GET["page"]; // GET 방식으로 넘어온 페이지 번호 가져오기
	
	$con = mysqli_connect("localhost", "user1", "12345", "music"); // 데이터베이스 연결
	$sql = "select * from board_general where num=$num"; // 해당 글의 정보를 가져오는 SQL 쿼리
	$result = mysqli_query($con, $sql); // 쿼리 실행
	$row = mysqli_fetch_array($result); // 결과를 배열로 변환
	$name       = $row["name"]; // 작성자 이름
	$subject    = $row["subject"]; // 제목
	$content    = $row["content"];	// 내용
	$file_name  = $row["file_name"]; // 첨부 파일 이름
?>
	    <form  name="board_form" method="post" action="board_modify.php?num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data"> <!-- 글 수정을 위한 폼 -->
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$name?></span> <!-- 작성자 이름 출력 -->
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span> <!-- 기존 제목 출력 후 수정 가능한 입력 필드 -->
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?=$content?></textarea> <!-- 기존 내용 출력 후 수정 가능한 텍스트 영역 -->
	    			</span>
	    		</li>
	    		<li>
			        <span class="col1"> 첨부 파일 : </span>
			        <span class="col2"><?=$file_name?></span> <!-- 기존 첨부 파일 이름 출력 -->
			    </li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">수정하기</button></li> <!-- 수정하기 버튼 클릭 시 입력 확인 함수 호출 -->
				<li><button type="button" onclick="location.href='board_list.php'">목록</button></li> <!-- 목록으로 돌아가는 버튼 -->
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
