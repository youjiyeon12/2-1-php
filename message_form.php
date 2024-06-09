<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?version=1">
<link rel="stylesheet" type="text/css" href="./css/message.css?version=1">
	<link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1">
<script>
  function check_input() { //입력창에 내용이 입력되었는지 검사, 내용을 입력한 경우 action 속성에 설정된 message_insert.php 페이지로 이동하여 쪽지 정보를 DB에 저장
  	  if (!document.message_form.rv_id.value)
      {
          alert("수신 아이디를 입력하세요!");
          document.message_form.rv_id.focus();
          return;
      }
      if (!document.message_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.message_form.subject.focus();
          return;
      }
      if (!document.message_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.message_form.content.focus();
          return;
      }
      document.message_form.submit();
   }
</script>
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<?php
	if (!$userid )
	{
		echo("<script>
				alert('로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
		exit;
	}
?>
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
	    		쪽지 보내기
		</h3>
		<ul class="top_buttons">
				<li><span><a href="message_box.php?mode=rv">수신 쪽지함 </a></span></li> <!-- 쪽지 보내기 페이지 오른쪽 상단에 수신쪽지함과 송신쪽지함 링크를 삽입, 이 링크는 
                                쪽지함 목록 보기 페이지(message_box.php)로 연결 -->
				<li><span><a href="message_box.php?mode=send">송신 쪽지함</a></span></li>
		</ul>
	    <form  name="message_form" method="post" action="message_insert.php?send_id=<?=$userid?>"> <!-- 사용자가 입력한 데이터를 DB에 저장하는 데 필요한 send_id 값으로 사용자 아이디인 
                $userid를 설정.-->
	    	<div id="write_msg">
	    	    <ul>
                        <!--나머지 모두 post방식으로 message_insert.php 전달-->
				<li>
					<span class="col1">보내는 사람 : </span>
					<span class="col2"><?=$userid?></span>
				</li>	
				<li>
					<span class="col1">수신 아이디 : </span>
					<span class="col2"><input name="rv_id" type="text"></span>
				</li>	
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text"></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea>
	    			</span>
	    		</li>
	    	    </ul>
                    <!--쪽지 보내기 페이지 하단의 <보내기>를 클릭하면 check_input() 함수를 호출-->
	    	    <button type="button" onclick="check_input()">보내기</button>
	    	</div>	    	
	    </form>
	</div> <!-- message_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
<script src="./js/img_slide.js"></script>