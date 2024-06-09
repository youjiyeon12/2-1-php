<?php
header('Content-Type: text/html; charset=utf-8');
session_start(); // 세션 시작

// 세션에서 사용자 아이디와 이름 가져오기
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"]; // 세션에서 사용자 아이디 가져오기
else $userid = ""; // 세션에 사용자 아이디가 없으면 빈 문자열로 초기화
if (isset($_SESSION["username"])) $username = $_SESSION["username"]; // 세션에서 사용자 이름 가져오기
else $username = ""; // 세션에 사용자 이름이 없으면 빈 문자열로 초기화

// 사용자 아이디가 없으면 로그인 후 이용 메시지를 출력하고 이전 페이지로 이동
if (!$userid) {
    echo("
        <script>
        alert('게시판 글쓰기는 로그인 후 이용해 주세요!'); // 경고창 출력
        history.go(-1); // 이전 페이지로 이동
        </script>
    ");
    exit; // 스크립트 종료
}

// 게시글 번호를 GET으로 받아옴
$num = $_GET["num"];

// 데이터베이스에 연결
$con = mysqli_connect("localhost", "user1", "12345", "music");

// 게시글 번호로 해당 게시글 정보를 가져오는 쿼리 실행
$sql = "SELECT * FROM board_manager WHERE num = $num";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

// 가져온 정보를 변수에 저장
$subject = $row["subject"]; // 제목
$name = $row["name"]; // 작성자 아이디
$regist_day = $row["regist_day"]; // 등록일

// 이미 찜한 목록인지 확인
$sql_check = "SELECT * FROM favorites WHERE mana_num = $num AND board_id = '$name' AND id = '$userid'";
$result_check = mysqli_query($con, $sql_check);
if(mysqli_num_rows($result_check) > 0) {
    // 이미 찜한 목록인 경우
    echo "<script>alert('이미 찜한 목록입니다.');</script>"; // 이미 찜한 목록이라는 경고창 출력
    echo "<script>location.href = 'managerboard_list.php';</script>"; // 게시판 목록 페이지로 이동
    exit; // 스크립트 종료
}

// favorites 테이블에 정보 삽입
$sql_insert = "INSERT INTO favorites (id, mana_num, subject, board_id, regist_day) VALUES ('$userid' ,'$num', '$subject', '$name', '$regist_day')";
$result_insert = mysqli_query($con, $sql_insert);

// 결과 반환
if ($result_insert) {
    echo "<script>alert('찜하기가 완료되었습니다.');</script>"; // 찜하기가 완료되었다는 경고창 출력
    echo "<script>location.href = 'managerboard_list.php';</script>"; // 게시판 목록 페이지로 이동
} else {
    echo "<script>alert('오류가 발생했습니다.');</script>"; // 오류가 발생했다는 경고창 출력
    echo "<script>location.href = 'managerboard_list.php';</script>"; // 게시판 목록 페이지로 이동
}

// 데이터베이스 연결 종료
mysqli_close($con);
?>
