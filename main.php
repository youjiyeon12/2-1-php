<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>공연 공지 게시글</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css?a"> <!-- 공통 스타일 시트 연결 -->
    <link rel="stylesheet" type="text/css" href="./css/main.css?a">
    <link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1">
</head>
<body>
    <!-- 메인 이미지 슬라이드 영역 -->
    <div id="main_img_bar">
        <div id="slider">
            <!-- 슬라이드 이미지들 -->
            <div class="slide"><img src="./img/nct.jpg"></div>
            <div class="slide"><img src="./img/aespa.jpg"></div>
            <div class="slide"><img src="./img/img7.gif"></div>
            <div class="slide"><img src="./img/black.jpg"></div>
        </div>
    </div>
    <!-- 메인 컨텐츠 영역 -->
    <div id="main_content">
        <div id="latest">
            <h4>공연 공지 게시글</h4>
            <ul>
                <!-- 최근 게시 글 DB에서 불러오기 -->
                <?php
                    $con = mysqli_connect("localhost", "user1", "12345", "music");
                    $sql = "select * from board_manager order by num desc limit 5";
                    $result = mysqli_query($con, $sql);

                    if (!$result)
                        echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
                    else
                    {
                        while($row = mysqli_fetch_array($result))
                        {
                            $regist_day = substr($row["regist_day"], 0, 10);
                ?>
                            <!-- 게시글 리스트 -->
                            <li>
                                <span><?=$row["subject"]?></span> <!-- 게시글 제목 -->
                                <span><?=$row["name"]?></span> <!-- 작성자 이름 -->
                                <span><?=$regist_day?></span> <!-- 등록일 -->
                            </li>
                <?php
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>
<script src="./js/img_slide.js"></script> <!-- 이미지 슬라이드 관련 자바스크립트 파일 -->
