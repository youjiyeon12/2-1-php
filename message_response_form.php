<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?version=1">
<link rel="stylesheet" type="text/css" href="./css/message.css?version=1">
<link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1">
<script>
  function check_input() { // 내용 입력 여부를 확인하는 함수
      if (!document.message_form.subject.value) // 제목이 입력되지 않은 경우
      {
          alert("제목을 입력하세요!");
          document.message_form.subject.focus(); // 제목 입력 필드에 포커스
          return;
      }
      if (!document.message_form.content.value) // 내용이 입력되지 않은 경우
      {
          alert("내용을 입력하세요!");    
          document.message_form.content.focus(); // 내용 입력 필드에 포커스
          return;
      }
      document.message_form.submit(); // 모든 입력이 완료된 경우 폼을 제출
   }
</script>
</head>
<body> 
<header>
    <?php include "header.php";?> <!-- 헤더를 포함하는 PHP 파일을 추가 -->
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
	    <h3 id="write_title">
	    		답변 쪽지 보내기 <!-- 페이지 제목 -->
		</h3>
<?php
	$num  = $_GET["num"]; // GET 방식으로 전달된 'num' 매개변수를 받아옴

	$con = mysqli_connect("localhost", "user1", "12345", "music"); // MySQL 데이터베이스에 접속
	$sql = "select * from message where num=$num"; // 해당 번호의 메시지 조회
	$result = mysqli_query($con, $sql); // 쿼리 실행

	$row = mysqli_fetch_array($result); // 결과를 배열로 변환하여 가져옴
	$send_id      = $row["send_id"];
	$rv_id      = $row["rv_id"];
	$subject    = $row["subject"];
	$content    = $row["content"];

	$subject = "RE: ".$subject; // 제목에 "RE:" 접두어 추가

	$content = "> ".$content; // 내용에 '>' 추가
	$content = str_replace("\n", "\n>", $content); // 개행 문자 처리
	$content = "\n\n\n-----------------------------------------------\n".$content; // 내용에 구분선 추가

	$result2 = mysqli_query($con, "select name from members where id='$send_id'"); // 보내는 사람의 이름 조회
	$record = mysqli_fetch_array($result2);
	$send_name    = $record["name"];
?>		
	    <form  name="message_form" method="post" action="message_insert.php?send_id=<?=$userid?>"> <!-- 메시지 삽입을 위한 폼 -->
	    	<input type="hidden" name="rv_id" value="<?=$send_id?>">
	    	<div id="write_msg">
	    	    <ul>
				<li>
					<span class="col1">보내는 사람 : </span>
					<span class="col2"><?=$userid?></span> <!-- 보내는 사람 아이디 표시 -->
				</li>	
				<li>
					<span class="col1">수신 아이디 : </span>
					<span class="col2"><?=$send_name?>(<?=$send_id?>)</span> <!-- 수신 아이디 표시 -->
				</li>	
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span> <!-- 제목 입력 필드 -->
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">글 내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?=$content?></textarea> <!-- 내용 입력 필드 -->
	    			</span>
	    		</li>
	    	    </ul>
	    	    <button type="button" onclick="check_input()">보내기</button> <!-- 보내기 버튼, 클릭 시 check_input() 함수 호출 -->
	    	</div>
	    </form>
	</div> <!-- message_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
<script src="./js/img_slide.js"></script> <!-- 이미지 슬라이드를 위한 자바스크립트 파일 -->
