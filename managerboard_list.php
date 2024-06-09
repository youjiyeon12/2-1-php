<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8"> <!-- 문서의 문자 인코딩 설정 -->
    <title>PHP 프로그래밍 입문</title> <!-- 문서 제목 설정 -->
    <link rel="stylesheet" type="text/css" href="./css/common.css?m"> <!-- 공통 CSS 파일 링크 -->
    <link rel="stylesheet" type="text/css" href="./css/board.css?version=1"> <!-- 게시판 CSS 파일 링크 -->
	<link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1">
</head>
<body> 
<header>
    <?php include "header.php";?> <!-- 헤더 포함 -->
</header>  
<section>
    <div id="main_img_bar">
        <div id="slider">
            <div class="slide"><img src="./img/nct.jpg"></div>
            <div class="slide"><img src="./img/aespa.jpg"></div>
            <div class="slide"><img src="./img/img7.gif"></div>
            <div class="slide"><img src="./img/black.jpg"></div>
        </div>

    </div>
    <div id="board_box">
        <h3>
            공연 공지 게시판 > 목록보기 <!-- 게시판 목록 보기 제목 -->
        </h3>
        <ul id="board_list">
            <li>
                <span class="col1">번호</span> <!-- 글 번호 열 제목 -->
                <span class="col2">제목</span> <!-- 제목 열 제목 -->
                <span class="col3">글쓴이</span> <!-- 글쓴이 열 제목 -->
                <span class="col4">첨부</span> <!-- 첨부 열 제목 -->
                <span class="col5">등록일</span> <!-- 등록일 열 제목 -->
                <span class="col6">조회</span> <!-- 조회수 열 제목 -->
                <span class="col7">찜하기</span> <!--찜하기-->
            </li>
            <?php
                if (isset($_GET["page"])) // 페이지 번호가 존재하는지 확인
                    $page = $_GET["page"]; // 현재 페이지 번호 설정
                else
                    $page = 1; // 기본 페이지 번호는 1로 설정

                $con = mysqli_connect("localhost", "user1", "12345", "music"); // 데이터베이스 연결
                $sql = "select * from board_manager order by num desc"; // 최신글부터 순서대로 불러오는 SQL 쿼리
                $result = mysqli_query($con, $sql); // 쿼리 실행
                $total_record = mysqli_num_rows($result); // 전체 글 수 계산

                $scale = 10; // 한 페이지에 보여줄 글 수

                // 전체 페이지 수 계산
                if ($total_record % $scale == 0)     
                    $total_page = floor($total_record/$scale);      
                else
                    $total_page = floor($total_record/$scale) + 1; 

                // 표시할 페이지에 따라 시작 위치 계산
                $start = ($page - 1) * $scale;      

                $number = $total_record - $start;

                for ($i=$start; $i<$start+$scale && $i < $total_record; $i++) {
                    mysqli_data_seek($result, $i); // 결과 포인터 이동
                    $row = mysqli_fetch_array($result); // 한 행씩 가져옴
                    $num         = $row["num"]; // 글 번호
                    $id          = $row["id"]; // 글쓴이 아이디
                    $name        = $row["name"]; // 글쓴이 이름
                    $subject     = $row["subject"]; // 제목
                    $regist_day  = $row["regist_day"]; // 등록일
                    $hit         = $row["hit"]; // 조회수
                    if ($row["file_name"])
                        $file_image = "<img src='./img/file.gif'>"; // 파일 아이콘 표시
                    else
                        $file_image = " "; // 파일 없을 경우 공백

            ?>
            <li>
                <span class="col1"><?=$number?></span> <!-- 글 번호 표시 -->
                <span class="col2"><a href="managerboard_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span> <!-- 제목 링크 -->
                <span class="col3"><?=$name?></span> <!-- 글쓴이 표시 -->
                <span class="col4"><?=$file_image?></span> <!-- 첨부 파일 표시 -->
                <span class="col5"><?=$regist_day?></span> <!-- 등록일 표시 -->
                <span class="col6"><?=$hit?></span> <!-- 조회수 표시 -->
                <span class ="col7"><button onclick="location.href='favorites.php?num=<?=$num?>'">찜하기</button></span>
            </li>   
            <?php
                $number--;
                }
                mysqli_close($con); // 데이터베이스 연결 종료
            ?>
        </ul>
        <ul id="page_num">     
            <?php
                // 이전 페이지 링크 출력
                if ($total_page>=2 && $page >= 2)  
                {
                    $new_page = $page-1;
                    echo "<li><a href='managerboard_list.php?page=$new_page'>◀ 이전</a></li>";
                }       
                else 
                    echo "<li>&nbsp;</li>";

                // 페이지 번호 출력
                for ($i=1; $i<=$total_page; $i++) {
                    if ($page == $i) { // 현재 페이지는 링크 없음
                        echo "<li><b> $i </b></li>";
                    } else {
                        echo "<li><a href='managerboard_list.php?page=$i'> $i </a><li>"; // 페이지 링크
                    }
                }

                // 다음 페이지 링크 출력
                if ($total_page>=2 && $page != $total_page)      
                {
                    $new_page = $page+1;    
                    echo "<li> <a href='managerboard_list.php?page=$new_page'>다음 ▶</a> </li>";
                }
                else 
                    echo "<li>&nbsp;</li>";
            ?>
        </ul> <!-- page_num -->
        <ul class="buttons">
            <li><button onclick="location.href='managerboard_list.php'">목록</button></li> <!-- 목록 버튼 -->
            <li>
                <?php 
                if ($userid && $userlevel == 1) { // 사용자 아이디가 존재하고, 사용자 등급이 1인 경우
                ?>
                    <button onclick="location.href='managerboard_form.php'">글쓰기</button> <!-- 글쓰기 버튼 -->
                <?php
                } else if (!$userid) {
                ?>
                    <a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a> <!-- 로그인 후 이용해 주세요 -->
                <?php
                } else {
                ?>
                    <a href="javascript:alert('관리자만 작성할 수 있습니다!')"><button>글쓰기</button></a> <!-- 관리자만 작성할 수 있습니다 -->
                <?php
                }
                ?>
            </li>
        </ul>
    </div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php"?>;
</footer>
</body><!-- ' -->
</html>
<script src="./js/img_slide.js"></script>