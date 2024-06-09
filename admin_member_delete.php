<?php
    session_start(); // 세션 시작

    // 세션에 사용자 레벨이 저장되어 있는지 확인
    if (isset($_SESSION["userlevel"])) 
        $userlevel = $_SESSION["userlevel"]; // 세션에서 사용자 레벨 가져오기
    else 
        $userlevel = ""; // 세션에 사용자 레벨이 없으면 빈 문자열로 설정

    // 사용자 레벨이 관리자(레벨 1)이 아니면 삭제할 수 없음
    if ($userlevel != 1) {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!'); // 알림 메시지 출력
            history.go(-1); // 이전 페이지로 돌아감
            </script>
        ");
        exit; // 스크립트 종료
    }

    $num   = $_GET["num"]; // GET 방식으로 받아온 회원 번호

    $con = mysqli_connect("localhost", "user1", "12345", "music"); // 데이터베이스 연결
    $sql = "delete from members where num = $num"; // 해당 회원 정보를 삭제하는 SQL 쿼리
    mysqli_query($con, $sql); // 쿼리 실행
    mysqli_close($con); // 데이터베이스 연결 종료

    // 회원 삭제 후 관리자 페이지로 이동하는 JavaScript 코드 출력
    echo "
        <script>
            location.href = 'admin.php'; // 관리자 페이지로 이동
        </script>
    ";
?>
