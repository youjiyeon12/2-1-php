<?php
    // GET 방식으로 전달된 'send_id' 매개변수를 받아옵니다.
    $send_id = $_GET["send_id"];

    // POST 방식으로 전달된 수신자 ID, 제목, 내용을 변수에 저장합니다.
    $rv_id = $_POST['rv_id'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    // HTML 특수 문자를 이스케이프 처리합니다.
    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    // 메시지 등록일을 현재 날짜와 시간으로 설정합니다.
    $regist_day = date("Y-m-d (H:i)");

    // 보내는 사용자 ID가 없는 경우, 로그인 후 이용하도록 경고 메시지를 출력하고 이전 페이지로 돌아갑니다.
    if(!$send_id) {
        echo("
            <script>
            alert('로그인 후 이용해 주세요! ');
            history.go(-1);
            </script>
        ");
        exit;
    }

    // MySQL 데이터베이스에 연결합니다.
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // 수신자 ID를 검색하여 해당하는 레코드 수를 확인합니다.
    $sql = "select * from members where id='$rv_id'";
    $result = mysqli_query($con, $sql);
    $num_record = mysqli_num_rows($result);

    // 수신자 ID가 존재하는 경우
    if($num_record) {
        // 메시지를 message 테이블에 삽입합니다.
        $sql = "insert into message (send_id, rv_id, subject, content,  regist_day) ";
        $sql .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
        mysqli_query($con, $sql);
    } else { // 수신자 ID가 존재하지 않는 경우
        // 경고 메시지를 출력하고 이전 페이지로 돌아갑니다.
        echo("
            <script>
            alert('수신 아이디가 잘못 되었습니다!');
            history.go(-1);
            </script>
        ");
        exit;
    }

    // MySQL 데이터베이스 연결을 닫습니다.
    mysqli_close($con);

    // 송신함 메시지함 페이지로 이동합니다.
    echo "
       <script>
        location.href = 'message_box.php?mode=send';
       </script>
    ";
?>
