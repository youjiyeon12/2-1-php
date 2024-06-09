<head>
    <meta charset="utf-8"> <!-- 문자 인코딩 설정 -->
</head>
<?php
    $id   = $_POST["id"]; // POST 방식으로 전송된 아이디를 받아 변수에 저장
    $pass = $_POST["pass"]; // POST 방식으로 전송된 비밀번호를 받아 변수에 저장

    $con = mysqli_connect("localhost", "user1", "12345", "music"); // MySQL 데이터베이스에 연결

    $sql = "select * from members where id='$id'"; // 입력한 아이디를 기준으로 사용자 정보를 가져오는 쿼리문
    $result = mysqli_query($con, $sql); // 쿼리 실행 후 결과를 저장

    $num_match = mysqli_num_rows($result); // 쿼리 결과에서 일치하는 레코드의 수를 저장

    if(!$num_match) // 만약 일치하는 레코드가 없으면
    {
        echo("
            <script>
                window.alert('등록되지 않은 아이디입니다!'); // 경고창 출력
                history.go(-1); // 이전 페이지로 이동
            </script>
        ");
    }
    else // 일치하는 레코드가 있다면
    {
        $row = mysqli_fetch_array($result); // 쿼리 결과에서 첫 번째 행을 배열로 가져옴
        $db_pass = $row["pass"]; // 데이터베이스에 저장된 해당 아이디의 비밀번호

        mysqli_close($con); // 데이터베이스 연결 종료

        if($pass != $db_pass) // 입력한 비밀번호가 데이터베이스에 저장된 비밀번호와 다르다면
        {
            echo("
                <script>
                    window.alert('비밀번호가 틀립니다!'); // 경고창 출력
                    history.go(-1); // 이전 페이지로 이동
                </script>
            ");
            exit; // 스크립트 종료
        }
        else // 입력한 비밀번호가 데이터베이스에 저장된 비밀번호와 일치한다면
        {
            session_start(); // 세션 시작

            // 사용자 정보를 세션 변수에 저장
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["name"];
            $_SESSION["userlevel"] = $row["level"];

            // 로그인 완료 후 메인 페이지로 이동
            echo("
                <script>
                    location.href = 'index.php'; 
                </script>
            ");
        }
    }        
?>
