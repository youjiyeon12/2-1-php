<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?version=1">
<link rel="stylesheet" type="text/css" href="./css/message.css?version=1">
<link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1">
</head>
<body> 
<header>
    <?php include "header.php";?> <!-- 헤더 파일을 포함 -->
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
   	<div id="message_box">
	    <h3 class="title">
<?php
	$mode = $_GET["mode"]; // GET 방식으로 전달된 'mode' 매개변수를 가져옴
	$num  = $_GET["num"]; // GET 방식으로 전달된 'num' 매개변수를 가져옴

	$con = mysqli_connect("localhost", "user1", "12345", "music"); // MySQL 데이터베이스에 접속
	$sql = "select * from message where num=$num"; // 해당 번호의 쪽지를 조회하는 쿼리
	$result = mysqli_query($con, $sql); // 쿼리 실행

	$row = mysqli_fetch_array($result); // 결과를 배열로 변환하여 가져옴
	$send_id    = $row["send_id"]; // 보내는 사람의 아이디
	$rv_id      = $row["rv_id"]; // 수신자의 아이디
	$regist_day = $row["regist_day"]; // 등록일
	$subject    = $row["subject"]; // 제목
	$content    = $row["content"]; // 내용

	$content = str_replace(" ", "&nbsp;", $content); // 공백 처리
	$content = str_replace("\n", "<br>", $content); // 개행 문자 처리

	if ($mode=="send") // 송신함인 경우
		$result2 = mysqli_query($con, "select name from members where id='$rv_id'"); // 수신자 이름 조회
	else // 수신함인 경우
		$result2 = mysqli_query($con, "select name from members where id='$send_id'"); // 보낸 사람 이름 조회

	$record = mysqli_fetch_array($result2); // 결과를 배열로 변환하여 가져옴
	$msg_name = $record["name"]; // 이름 가져옴

	if ($mode=="send")	    	
	    echo "송신 쪽지함 > 내용보기"; // 송신함인 경우 페이지 제목 표시
	else
		echo "수신 쪽지함 > 내용보기"; // 수신함인 경우 페이지 제목 표시
?>
		</h3>
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$msg_name?> | <?=$regist_day?></span>
			</li>
			<li>
				<?=$content?> <!-- 쪽지 내용 표시 -->
			</li>		
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li> <!-- 수신 쪽지함 버튼 -->
				<li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li> <!-- 송신 쪽지함 버튼 -->
				<li><button onclick="location.href='message_response_form.php?num=<?=$num?>'">답변 쪽지</button></li> <!-- 답변 쪽지 버튼 -->
				<li><button onclick="location.href='message_delete.php?num=<?=$num?>&mode=<?=$mode?>'">삭제</button></li> <!-- 삭제 버튼 -->
		</ul>
	</div> <!-- message_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
<script src="./js/img_slide.js"></script> <!-- 이미지 슬라이드를 위한 자바스크립트 파일 -->
