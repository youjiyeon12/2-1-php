<?php
    $num = $_GET["num"]; // 수정할 글의 번호를 GET 방식으로 받아옴
    $page = $_GET["page"]; // 현재 페이지 번호를 GET 방식으로 받아옴

    $subject = $_POST["subject"]; // 수정된 제목을 POST 방식으로 받아옴
    $content = $_POST["content"]; // 수정된 내용을 POST 방식으로 받아옴
          
    $con = mysqli_connect("localhost", "user1", "12345", "music"); // MySQL 데이터베이스에 연결
    $sql = "update board_manager set subject='$subject', content='$content' "; // 수정된 제목과 내용을 업데이트하는 SQL 쿼리문
    $sql .= " where num=$num"; // 수정할 글의 번호를 기준으로 WHERE 절 추가
    mysqli_query($con, $sql); // SQL 쿼리 실행하여 글 수정

    mysqli_close($con); // MySQL 데이터베이스 연결 종료

    echo "
	      <script>
	          location.href = 'managerboard_list.php?page=$page'; // 글 수정 후 글 목록 페이지로 이동하는 자바스크립트 코드
	      </script>
	  ";
?>
