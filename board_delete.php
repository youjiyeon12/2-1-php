<?php

    $num   = $_GET["num"]; // 게시글 번호(get 방식으로 가져옴)
    $page   = $_GET["page"]; // 게시글 목록 페이지 번호(get 방식으로 가져옴)

    $con = mysqli_connect("localhost", "user1", "12345", "music"); // 데이터베이스 연결 설정
    $sql = "select * from board_general where num = $num"; // 데이터베이스에서 가져온 배열에서 파일 이름을 저장
    $result = mysqli_query($con, $sql);  // 데이터베이스에 쿼리를 실행하고 결과를 변수에 저장
    $row = mysqli_fetch_array($result); //쿼리 결과에서 가져온 행 데이터를 저장(배열 순서)

    $copied_name = $row["file_copied"];  // 데이터베이스에서 가져온 배열에서 파일 이름을 저장

	if ($copied_name) // 만약 파일 이름이 존재하면
	{
		$file_path = "./data/".$copied_name; // 파일 경로를 설정
		unlink($file_path); // 서버에서 파일을 삭제
    }

    $sql = "delete from board_general where num = $num"; // 게시글 번호에 해당하는 게시글을 삭제하는 쿼리 문자열 설정
    mysqli_query($con, $sql); // 데이터베이스에 쿼리를 실행하여 게시글을 삭제
    mysqli_close($con); // 데이터베이스 연결을 종료

    echo "
	     <script>
	         location.href = 'board_list.php?page=$page'; // 게시글 목록 페이지로 이동
	     </script>
	   ";
?>

