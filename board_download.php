<?php
    // URL에서 GET 방식으로 전달된 변수들을 가져와서 각각의 변수에 저장
    $real_name = $_GET["real_name"]; // 실제 파일명
    $file_name = $_GET["file_name"]; // 다운로드할 파일명
    $file_type = $_GET["file_type"]; // 파일 유형
    $file_path = "./data/".$real_name; // 파일이 저장된 경로

    // 사용자의 브라우저가 IE인지를 판별하여 변수 $ie에 저장
    $ie = preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || 
        (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0') !== false && 
            strpos($_SERVER['HTTP_USER_AGENT'], 'rv:11.0') !== false);

    // 만약 사용자의 브라우저가 IE라면 한글 파일명이 깨지는 문제를 방지하기 위해 아래 코드 실행
    if ($ie) {
         $file_name = iconv('utf-8', 'CP949', $file_name); // 파일명을 UTF-8에서 CP949로 변환
    }

    // 파일이 존재하는지 여부를 확인
    if (file_exists($file_path)) { 
		$fp = fopen($file_path,"rb"); // 파일을 읽기 전용으로 열기
		Header("Content-type: application/x-msdownload"); // 다운로드할 파일의 MIME 유형 설정
        Header("Content-Length: ".filesize($file_path)); // 다운로드할 파일의 크기 설정     
        Header("Content-Disposition: attachment; filename=".$file_name); // 다운로드할 파일명 설정   
        Header("Content-Transfer-Encoding: binary"); // 전송 인코딩 설정
		Header("Content-Description: File Transfer"); // 컨텐츠 설명 설정
        Header("Expires: 0"); // 캐시 만료 설정      
    } 
	
    // 파일을 읽어서 출력
    if (!fpassthru($fp)) 
		fclose($fp); // 파일 포인터 닫기
?>
