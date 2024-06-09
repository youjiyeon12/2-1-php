<?php
    session_start(); // 세션 시작
    // 세션에서 사용자 ID와 이름을 가져옴
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";

    // 로그인이 되어 있지 않으면 경고 메시지를 표시하고 이전 페이지로 돌아감
    if ( !$userid )
    {
        echo("
                    <script>
                    alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
                    history.go(-1)
                    </script>
        ");
        exit;
    }

    // 폼에서 전달된 제목과 내용을 가져옴
    $subject = $_POST["subject"];
    $content = $_POST["content"];

    // HTML 특수 문자를 변환하여 저장
    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    // 현재의 '년-월-일-시-분'을 저장
    $regist_day = date("Y-m-d (H:i)");

    // 파일 업로드 디렉토리 설정
    $upload_dir = './data/';

    // 파일 업로드 관련 변수 초기화
    $upfile_name = $_FILES["upfile"]["name"];
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
    $upfile_type = $_FILES["upfile"]["type"];
    $upfile_size = $_FILES["upfile"]["size"];
    $upfile_error = $_FILES["upfile"]["error"];

    // 파일이 정상적으로 업로드 되었는지 확인
    if ($upfile_name && !$upfile_error)
    {
        $file = explode(".", $upfile_name);
        $file_name = $file[0];
        $file_ext = $file[1];

        // 새로운 파일 이름 생성
        $new_file_name = date("Y_m_d_H_i_s");
        $copied_file_name = $new_file_name . "." . $file_ext;      
        $uploaded_file = $upload_dir . $copied_file_name;

        // 파일 크기 제한 확인 (1MB 초과 시 오류)
        if( $upfile_size  > 1000000 ) {
            echo("
            <script>
            alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
            history.go(-1)
            </script>
            ");
            exit;
        }

        // 파일을 지정된 디렉토리로 이동
        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )
        {
            echo("
                <script>
                alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                history.go(-1)
                </script>
            ");
            exit;
        }
    }
    else 
    {
        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";
    }
    
    // MySQL 데이터베이스에 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // 게시글 삽입을 위한 SQL 쿼리 작성
    $sql = "insert into board_general (id, name, subject, content, regist_day, hit, file_name, file_type, file_copied) ";
    $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
    $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
    mysqli_query($con, $sql);  // SQL 명령 실행

    // MySQL 연결 종료
    mysqli_close($con);

    // 게시글 목록 페이지로 이동
    echo "
       <script>
        location.href = 'board_list.php';
       </script>
    ";
?>
