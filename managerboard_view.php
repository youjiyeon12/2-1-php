<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8"> <!-- 문서의 문자 인코딩을 UTF-8로 설정 -->
<title>PHP 프로그래밍 입문</title> <!-- 문서 제목 설정 -->
<link rel="stylesheet" type="text/css" href="./css/common.css?version=1"> <!-- 공통 CSS 파일 링크 -->
<link rel="stylesheet" type="text/css" href="./css/board.css?version=1"> <!-- 게시판 전용 CSS 파일 링크 -->
	<link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1">
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
	    <h3 class="title">
			공연 공지 게시판 > 내용보기 <!-- 게시판 내용보기 제목 -->
		</h3>
<?php
	$num  = $_GET["num"]; // GET 방식으로 전달된 글 번호 저장
	// GET 방식으로 전달된 페이지 번호가 있는지 확인하고, 있으면 해당 값을 사용합니다. 없는 경우 기본값으로 1을 사용합니다.
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;

	$con = mysqli_connect("localhost", "user1", "12345", "music"); // MySQL 데이터베이스에 연결
	$sql = "select * from board_manager where num=$num"; // 해당 글 번호에 해당하는 게시글을 불러오는 SQL 쿼리문
	$result = mysqli_query($con, $sql); // SQL 쿼리 실행하여 결과를 가져옴

	$row = mysqli_fetch_array($result); // 결과를 배열로 변환
	$id      = $row["id"]; // 작성자 아이디
	$name      = $row["name"]; // 작성자 이름
	$regist_day = $row["regist_day"]; // 작성일
	$subject    = $row["subject"]; // 글 제목
	$content    = $row["content"]; // 글 내용
	$file_name    = $row["file_name"]; // 첨부 파일 이름
	$file_type    = $row["file_type"]; // 첨부 파일 타입
	$file_copied  = $row["file_copied"]; // 첨부 파일의 서버에 저장된 이름
	$hit          = $row["hit"]; // 조회수

	$content = str_replace(" ", "&nbsp;", $content); // 공백을 HTML 공백 문자로 변환
	$content = str_replace("\n", "<br>", $content); // 줄 바꿈을 HTML 줄 바꿈 태그로 변환

	$new_hit = $hit + 1; // 조회수 1 증가
	$sql = "update board_manager set hit=$new_hit where num=$num"; // 조회수 업데이트하는 SQL 쿼리문
	mysqli_query($con, $sql); // SQL 쿼리 실행
?>		
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span> <!-- 제목 표시 -->
				<span class="col2"><?=$name?> | <?=$regist_day?></span> <!-- 작성자 이름과 작성일 표시 -->
			</li>
			<li>
				<?php
					if($file_name) { // 첨부 파일이 있는 경우
						$real_name = $file_copied; // 서버에 저장된 파일명
						$file_path = "./data/".$real_name; // 파일 경로
						$file_size = filesize($file_path); // 파일 크기 계산

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='managerboard_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
			           	}
				?>
				<?=$content?> <!-- 글 내용 표시 -->
			</li>		
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='managerboard_list.php?page=<?=$page?>'">목록</button></li> <!-- 목록으로 돌아가기 버튼 -->
				<li><button onclick="location.href='managerboard_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li> <!-- 수정하기 버튼 -->
				<li><button onclick="location.href='managerboard_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li> <!-- 삭제하기 버튼 -->
				<li><button onclick="location.href='managerboard_form.php'">글쓰기</button></li> <!-- 글쓰기 버튼 -->
		</ul>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?> <!-- 푸터 영역 include -->
</footer>
</body>
</html>
<script src="./js/img_slide.js"></script>
