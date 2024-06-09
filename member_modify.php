<?php
    $id = $_GET["id"]; // GET 방식으로 전달된 id를 변수 $id에 저장

    // POST로 전달된 데이터 받기
    $pass = $_POST["pass"]; // 비밀번호
    $name = $_POST["name"]; // 이름
    $phone = $_POST["phone"]; // 전화번호
    $age = $_POST["age"]; // 나이
    $gender = $_POST["gender"]; // 성별
    $address = $_POST["address"]; // 주소
    $hobby = isset($_POST["hobby"]) ? implode(",", $_POST["hobby"]) : ""; // 관심분야 (배열을 문자열로 변환하여 저장)
    $regist_day = date("Y-m-d (H:i)"); // 현재 날짜와 시간
    $level = 9; // 기본 회원 레벨 설정
    $musician = $_POST["musician"]; // 뮤지션 여부

    // 사용자가 '뮤지션 여부'를 선택한 경우에만 실행
    if(isset($_POST["musician"]) && $_POST["musician"] == '예') {
        $level = 2; // 뮤지션인 경우 레벨을 2로 설정
        $musician = "예"; // 뮤지션 여부를 '예'로 설정
    }
    
    $introduction  = $_POST["introduction"]; // 가입인사/자기소개

    // 파일 업로드 관련 처리
    $upload_dir    = './data/'; // 업로드 디렉토리 설정

    $upfile_name   = $_FILES["upfile"]["name"]; // 업로드한 파일명
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"]; // 임시 파일명
    $upfile_type   = $_FILES["upfile"]["type"]; // 파일 타입
    $upfile_size   = $_FILES["upfile"]["size"]; // 파일 크기
    $upfile_error  = $_FILES["upfile"]["error"]; // 업로드 오류 여부

    // 파일이 존재하고 업로드 오류가 없는 경우
    if ($upfile_name && !$upfile_error) {
        $file = explode(".", $upfile_name); // 파일명에서 확장자 추출
        $file_name = $file[0]; // 파일명
        $file_ext  = $file[1]; // 확장자

        $new_file_name = date("Y_m_d_H_i_s"); // 새로운 파일명 생성
        $copied_file_name = $new_file_name.".".$file_ext; // 새로운 파일명과 확장자 결합
        $uploaded_file = $upload_dir.$copied_file_name; // 업로드된 파일 경로

        // 업로드 파일 크기 제한 (1MB)
        if( $upfile_size  > 1000000 ) {
            echo("<script>alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! '); history.go(-1);</script>");
            exit; // 스크립트 종료
        }

        // 파일을 지정한 디렉토리로 이동하여 복사
        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
            echo("<script>alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.'); history.go(-1);</script>");
            exit; // 스크립트 종료
        }
    }
   
    $con = mysqli_connect("localhost", "user1", "12345", "music"); // MySQL 서버에 연결

    // 회원 정보 업데이트 쿼리 작성
    $sql = "UPDATE members SET pass='$pass', name='$name', phone='$phone', age='$age', gender='$gender', address='$address', hobby='$hobby', level='$level', introduction='$introduction', musician='$musician'";
    
    // 대표이미지가 업로드된 경우에만 파일명 업데이트
    if(isset($copied_file_name)) {
        $sql .= ", file_name='$copied_file_name'";
    }
    
    $sql .= " where id='$id'"; // 조건에 해당하는 회원의 정보를 업데이트

    mysqli_query($con, $sql); // 쿼리 실행
    mysqli_close($con); // MySQL 연결 종료

    // 메인 페이지로 이동
    echo "<script>location.href = 'index.php';</script>";
?>
