<?php
    $num = $_GET["num"]; // URL 매개변수로부터 글 번호 가져오기
    $page = $_GET["page"]; // URL 매개변수로부터 페이지 번호 가져오기

    $subject = $_POST["subject"]; // 폼으로부터 제목 가져오기
    $content = $_POST["content"]; // 폼으로부터 내용 가져오기
          
    $con = mysqli_connect("localhost", "user1", "12345", "music"); // 데이터베이스 연결
    $sql = "update board_general set subject='$subject', content='$content' "; // 해당 글의 제목과 내용 업데이트하는 SQL 쿼리 작성
    $sql .= " where num=$num"; // 해당하는 글 번호의 글만 업데이트
    mysqli_query($con, $sql); // 쿼리 실행

    mysqli_close($con); // 데이터베이스 연결 종료

    // 글 수정 후 게시판 목록 페이지로 이동하는 자바스크립트 출력
    echo "
        <script>
            location.href = 'board_list.php?page=$page'; // 게시판 목록 페이지로 이동
        </script>
    ";
?>
