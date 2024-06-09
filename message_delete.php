<?php

    $num = $_GET["num"]; // URL 매개변수로부터 메시지의 고유 번호를 가져옴

    $mode = $_GET["mode"]; // URL 매개변수로부터 모드(송신함 또는 수신함)를 가져옴

    // MySQL 서버에 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // 메시지를 삭제하는 SQL 쿼리
    $sql = "delete from message where num=$num";

    mysqli_query($con, $sql); // SQL 쿼리 실행하여 데이터베이스에서 메시지 삭제

    mysqli_close($con); // MySQL 연결 종료

    //$mode가 send이면 $url을 송신 쪽지함인 message_box.php로 설정
    if($mode == "send")
        $url = "message_box.php?mode=send";
    else
        $url = "message_box.php?mode=rv";

    // 페이지를 $url로 이동하는 자바스크립트 코드 출력
    echo "
    <script>
        location.href = '$url'; 
    </script>
    ";

?>

