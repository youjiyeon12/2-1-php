<?php
    session_start(); // 세션 시작

    // 세션에서 사용자 아이디와 이름 가져오기
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";

    // 사용자 아이디가 없으면 로그인 후 이용 메시지를 출력하고 이전 페이지로 이동
    if ( !$userid )
    {
        echo("
                    <script>
                    alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
                    history.go(-1)
                    </script>
        ");
        exit; // 스크립트 종료
    }

    // POST 방식으로 전달된 제목과 내용 가져오기
    $subject = $_POST["subject"];
    $content = $_POST["content"];

	// HTML 특수문자를 이스케이프하여 보안 강화
	$subject = htmlspecialchars($subject, ENT_QUOTES);
	$content = htmlspecialchars($content, ENT_QUOTES);

	// 현재 시간 가져오기
	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분' 형식으로 저장

	$upload_dir = './data/'; // 파일 업로드 디렉토리 설정

	// 파일 정보 가져오기
	$upfile_name	 = $_FILES["upfile"]["name"];
	$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
	$upfile_type     = $_FILES["upfile"]["type"];
	$upfile_size     = $_FILES["upfile"]["size"];
	$upfile_error    = $_FILES["upfile"]["error"];

	// 파일이 존재하고 업로드 오류가 없는 경우
	if ($upfile_name && !$upfile_error)
	{
		$file = explode(".", $upfile_name); // 파일명에서 확장자 추출
		$file_name = $file[0];
		$file_ext  = $file[1];

		$new_file_name = date("Y_m_d_H_i_s"); // 새로운 파일명 생성
		$new_file_name = $new_file_name;
		$copied_file_name = $new_file_name.".".$file_ext; // 새로운 파일명과 확장자 결합
		$uploaded_file = $upload_dir.$copied_file_name; // 업로드된 파일 경로 설정

		// 업로드 파일 크기 제한 (1MB)
		if( $upfile_size  > 1000000 ) {
			echo("
			<script>
			alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
			history.go(-1)
			</script>
			");
			exit; // 스크립트 종료
		}

		// 파일을 지정한 디렉토리로 이동하여 복사
		if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )
		{
			echo("
				<script>
				alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
				history.go(-1)
				</script>
			");
			exit; // 스크립트 종료
		}
	}
	else 
	{
		$upfile_name      = ""; // 파일명 초기화
		$upfile_type      = ""; // 파일 타입 초기화
		$copied_file_name = ""; // 복사된 파일명 초기화
	}
	
	$con = mysqli_connect("localhost", "user1", "12345", "music"); // 데이터베이스에 연결

	// 게시글 데이터를 삽입하는 쿼리문 작성
	$sql = "insert into board_manager (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
	$sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
	$sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
	mysqli_query($con, $sql);  // 쿼리 실행

	mysqli_close($con); // 데이터베이스 연결 종료

	echo "
	   <script>
	    location.href = 'managerboard_list.php'; // 게시판 목록 페이지로 이동
	   </script>
	"; // 자바스크립트로 페이지 이동
?>
