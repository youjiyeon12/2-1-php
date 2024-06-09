<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?version=1">
<link rel="stylesheet" type="text/css" href="./css/board.css?version=1">
	<link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1">
<script>
  function check_input() { // 내용 입력 여부를 확인하는 함수
      if (!document.musicianboard_form.subject.value) // 제목이 입력되지 않았을 경우
      {
          alert("제목을 입력하세요!");
          document.musicianboard_form.subject.focus(); // 포커스를 제목 입력란으로 이동
          return;
      }
      if (!document.musicianboard_form.content.value) // 내용이 입력되지 않았을 경우
      {
          alert("내용을 입력하세요!");    
          document.musicianboard_form.content.focus(); // 포커스를 내용 입력란으로 이동
          return;
      }
      document.musicianboard_form.submit(); // 모든 입력이 완료되면 폼 제출
   }
</script>
</head>
<body> 
<header>
    <?php include "header.php";?> <!-- 헤더 파일 포함 -->
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
	$num  = $_GET["num"]; // URL 매개변수로부터 글 번호 가져오기
	$page = $_GET["page"]; // URL 매개변수로부터 페이지 번호 가져오기
	
	$con = mysqli_connect("localhost", "user1", "12345", "music"); // 데이터베이스 연결
	$sql = "select * from board_musician where num=$num"; // 해당 글 정보를 가져오는 SQL 쿼리
	$result = mysqli_query($con, $sql); // SQL 실행
	$row = mysqli_fetch_array($result); // 결과 가져오기
	$name       = $row["name"]; // 글쓴이
	$subject    = $row["subject"]; // 제목
	$content    = $row["content"]; // 내용
	$file_name  = $row["file_name"]; // 첨부 파일명
?>
	    <form name="musicianboard_form" method="post" action="musicianboard_modify.php?num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$name?></span>
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span> <!-- 현재 제목 표시 -->
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?=$content?></textarea> <!-- 현재 내용 표시 -->
	    			</span>
	    		</li>
	    		<li>
			        <span class="col1"> 첨부 파일 : </span>
			        <span class="col2"><?=$file_name?></span> <!-- 현재 첨부 파일명 표시 -->
			    </li>
	    	</ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">수정하기</button></li> <!-- 수정하기 버튼 -->
				<li><button type="button" onclick="location.href='musicianboard_list.php'">목록</button></li> <!-- 목록으로 돌아가기 버튼 -->
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?> <!-- 푸터 파일 포함 -->
</footer>
</body>
</html>
<script src="./js/img_slide.js"></script>