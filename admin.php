<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?a">
<link rel="stylesheet" type="text/css" href="./css/admin.css?a">
</head>
<body> 
<header>
    <?php include "header.php";?> <!-- header.php 파일 포함 -->
</header>  
<section>
   	<div id="admin_box"> <!--CSS-->
	    <h3 id="member_title">
	    	관리자 모드 > 회원 관리
		</h3>
	    <ul id="member_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">아이디</span>
					<span class="col3">이름</span>
					<span class="col4">레벨</span>
					<span class="col6">가입일</span>
					<span class="col7">수정</span>
					<span class="col8">삭제</span>
				</li>
<?php
	$con = mysqli_connect("localhost", "user1", "12345", "music"); // 데이터베이스에 연결
	$sql = "select * from members order by num desc"; // 회원 정보를 가져오는 SQL 쿼리
	$result = mysqli_query($con, $sql); // 쿼리 실행 및 결과 저장
	$total_record = mysqli_num_rows($result); // 전체 회원 수 계산

	$number = $total_record; // 회원 번호 설정


   while ($row = mysqli_fetch_array($result)) // 결과 배열에서 한 행씩 가져옴
   {
        $num         = $row["num"]; // 회원 번호
        $id          = $row["id"]; // 회원 아이디
        $name        = $row["name"]; // 회원 이름
        $level       = $row["level"]; // 회원 레벨
        $regist_day  = $row["regist_day"]; // 회원 가입일
?>
			
		<li>
		<form method="post" action="admin_member_update.php?num=<?=$num?>">  <!-- 회원 정보 수정 폼 -->
			<span class="col1"><?=$number?></span> <!-- 회원 번호 -->
			<span class="col2"><?=$id?></a></span> <!-- 회원 번호 -->
			<span class="col3"><?=$name?></span>  <!-- 회원 이름 -->
			<span class="col4"><input type="text" name="level" value="<?=$level?>"></span> <!-- 회원 레벨 입력란 -->
			<span class="col6"><?=$regist_day?></span> <!-- 회원 가입일 -->
			<span class="col7"><button type="submit">수정</button></span> <!-- 수정 버튼 -->
			<span class="col8"><button type="button" onclick="location.href='admin_member_delete.php?num=<?=$num?>'">삭제</button></span> <!-- 삭제 버튼 -->
		</form>
		</li>	
			
<?php
   	   $number--; // 회원 번호 감소
   }
?>
	    </ul>
	    <h3 id="member_title">
	    	관리자 모드 > 게시판 관리
		</h3>
	    <ul id="board_list">
		<li class="title">
			<span class="col1">선택</span>
			<span class="col2">번호</span>
			<span class="col3">이름</span>
			<span class="col4">제목</span>
			<span class="col5">첨부파일명</span>
			<span class="col6">작성일</span>
		</li>
		<form method="post" action="admin_board_delete.php"> <!-- 게시글 삭제 폼 -->
<?php
	$sql =  $sql = "SELECT * FROM board_general UNION SELECT * FROM board_musician UNION SELECT * FROM board_manager ORDER BY num DESC";
	$result = mysqli_query($con, $sql);  // 쿼리 실행 및 결과 저장
	$total_record = mysqli_num_rows($result);  // 전체 게시글 수 계산

	$number = $total_record; // 게시글 번호 설정

   while ($row = mysqli_fetch_array($result)) // 결과 배열에서 한 행씩 가져옴
   {
        $num         = $row["num"]; // 게시글 번호
        $name        = $row["name"]; // 작성자 이름
        $subject     = $row["subject"]; // 게시글 제목
        $file_name   = $row["file_name"]; // 첨부파일명
        $regist_day  = $row["regist_day"]; // 작성일
        $regist_day  = substr($regist_day, 0, 10) // 작성일 형식 조정 (날짜만)
?>
		<li>
			<span class="col1"><input type="checkbox" name="item[]" value="<?=$num?>"></span>  <!-- 삭제할 게시글 선택 체크박스 -->
			<span class="col2"><?=$number?></span> <!-- 게시글 번호 -->
			<span class="col3"><?=$name?></span> <!-- 작성자 이름 -->
			<span class="col4"><?=$subject?></span> <!-- 게시글 제목 -->
			<span class="col5"><?=$file_name?></span> <!-- 첨부파일명 -->
			<span class="col6"><?=$regist_day?></span> <!-- 작성일 -->
		</li>	
<?php
   	   $number--; // 게시글 번호 감소
   }
   mysqli_close($con); // 데이터베이스 연결 종료
?>
				<button type="submit">선택된 글 삭제</button> <!-- 선택된 글 삭제 버튼 -->
			</form>
	    </ul>
	</div> <!-- admin_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
