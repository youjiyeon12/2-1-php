<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8"> <!-- 문자 인코딩 설정 -->
    <title>PHP 프로그래밍 입문</title> <!-- 웹 페이지 제목 설정 -->
    <link rel="stylesheet" type="text/css" href="./css/common.css?"> <!-- 공통 CSS 파일 링크 -->
    <link rel="stylesheet" type="text/css" href="./css/main.css?"> <!-- 메인 CSS 파일 링크 -->
</head>
<body> 
    <header>
        <?php include "header.php";?> <!-- 헤더 영역을 PHP 파일로부터 가져와서 삽입 -->
    </header>
    <section>
        <?php include "main.php";?> <!-- 메인 영역을 PHP 파일로부터 가져와서 삽입 -->
    </section> 
    <footer>
        <?php include "footer.php";?> <!-- 푸터 영역을 PHP 파일로부터 가져와서 삽입 -->
    </footer>
</body>
</html>
