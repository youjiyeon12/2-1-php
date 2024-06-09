<?php
    // URL 매개변수에서 글 번호와 페이지 번호를 가져옴
    $num = $_GET["num"];
    $page = $_GET["page"];

    // POST 요청으로부터 제목과 내용을 가져옴
    $subject = $_POST["subject"];
    $content = $_POST["content"];
          
    // 데이터베이스에 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // 글 수정을 위한 SQL 쿼리 생성
    $sql = "update board_musician set subject='$subject', content='$content' ";
    $sql .= " where num=$num";

    // SQL 쿼리 실행
    mysqli_query($con, $sql);

    // 데이터베이스 연결 종료
    mysqli_close($con);     

    // 글 수정이 완료되면 리스트 페이지로 이동하는 JavaScript 코드 출력
    echo "
	      <script>
	          location.href = 'musicianboard_list.php?page=$page'; // 리스트 페이지로 이동
	      </script>
	  ";
?>
