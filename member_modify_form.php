 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP 프로그래밍 입문</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css?">
    <link rel="stylesheet" type="text/css" href="./css/member.css?a">
    <link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1">
    <script type="text/javascript" src="./js/member_modify.js?"></script>
</head>
<body> 
    <!-- 헤더 부분에 header.php를 포함 -->
    <header>
        <?php include "header.php";?>
    </header>

<?php    
    // MySQL 서버에 접속
    $con = mysqli_connect("localhost", "user1", "12345", "music"); 
    // 로그인한 사용자의 아이디로 members 테이블에서 데이터를 조회
    $sql = "select * from members where id='$userid'";
    $result = mysqli_query($con, $sql); // SQL 쿼리를 실행하여 결과를 $result에 저장
    $row = mysqli_fetch_array($result); // 결과를 배열로 변환하여 $row에 저장

    // 데이터베이스에서 가져온 비밀번호와 이름을 변수에 저장
    $id = $row["id"];
    $pass = $row["pass"]; 
    $name = $row["name"];
    $phone = $row["phone"];
    $age = $row["age"];
    $address = $row["address"];
    $gender = $row["gender"];
    $hobbies = explode(',', $row["hobby"]);
    $introduction = $row["introduction"]; 
    $file_name = $row["file_name"];
    $musician = $row["musician"]; 

    // MySQL 연결 종료
    mysqli_close($con);
?>
    <section>
        <div id="main_img_bar">
        <div id="slider">
            <div class="slide"><img src="./img/nct.jpg"></div>
            <div class="slide"><img src="./img/aespa.jpg"></div>
            <div class="slide"><img src="./img/img7.gif"></div>
            <div class="slide"><img src="./img/black.jpg"></div>
        </div>
        </div>
        <div id="main_content">
            <div id="join_box">
                <!-- 회원 정보 수정 폼 -->
                <form name="member_form" method="post" action="member_modify.php?id=<?=$userid?>"> 
                    <!-- 비밀번호와 비밀번호 확인에 입력한 값이 일치하면 action 속성에 설정된 member_modify.php로 이동 -->
                    <h2>회원 정보수정</h2>
                    <div class="form id">
                        <div class="col1">아이디</div>
                        <div class="col2">
                            <?=$userid?> <!-- 사용자의 아이디 출력 -->
                        </div>                 
                    </div>
                    <div class="clear"></div>

                    <div class="form">
                        <div class="col1">비밀번호</div>
                        <div class="col2">
                            <input type="password" name="pass" value="<?=$pass?>"> <!-- 비밀번호 입력 필드 -->
                        </div>                 
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">비밀번호 확인</div>
                        <div class="col2">
                            <input type="password" name="pass_confirm" value="<?=$pass?>"> <!-- 비밀번호 확인 입력 필드 -->
                        </div>                 
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">이름</div>
                        <div class="col2">
                            <input type="text" name="name" value="<?=$name?>"> <!-- 이름 입력 필드 -->
                        </div>                 
                    </div>                

                    <div class="clear"></div>

                    <!-- 추가된 입력 필드 -->
                    <div class="form">
                        <div class="col1">나이</div>
                        <div class="col2">
                            <input type="text" name="age" value="<?=$age?>"> <!-- 나이 입력 필드 -->
                        </div>                 
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">전화번호</div>
                        <div class="col2">
                            <input type="text" name="phone" value="<?=$phone?>"> <!-- 전화번호 입력 필드 -->
                        </div>                 
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">주소</div>
                        <div class="col2">
                            <input type="text" name="address" value="<?=$address?>"> <!-- 주소 입력 필드 -->
                        </div>                 
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">성별</div>
                        <div class="col4">
                            <label><input type="radio" name="gender" value="여" <?php if($gender === "여") echo "checked"; ?>>여</label> <!-- 성별 라디오 버튼 -->
                            <label><input type="radio" name="gender" value="남" <?php if($gender === "남") echo "checked"; ?>>남</label>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="form">
                        <div class="col1">취미/관심분야</div>
                        <div class="col4">
                            <?php
                            $hobbies_list = array("재즈", "클래식", "발라드", "팝송", "K-pop", "J-pop");
                            foreach($hobbies_list as $hobby) {
                                $checked = in_array($hobby, $hobbies) ? "checked" : ""; // 취미/관심분야 체크 여부 확인
                                echo "<label><input type='checkbox' name='hobby[]' value='$hobby' $checked>$hobby</label>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="form">
                        <div class="col1">가입인사/자기소개</div>
                        <div class="col2">
                            <textarea name="introduction" rows="5" cols="50"><?=$introduction?></textarea> <!-- 자기소개 텍스트 입력 -->
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="form">
                        <div class="col1">대표이미지</div>
                        <div class="col4">
                            <input type="file" name="upfile"> <!-- 대표이미지 파일 업로드 -->
                        </div>
                    </div>
                    
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">뮤지션 여부</div>
                        <div class="col4">
                            <label><input type="radio" name="musician" value="예" <?php if($musician === "예") echo "checked"; ?>>예</label> <!-- 뮤지션 여부 버튼 -->
                            <label><input type="radio" name="musician" value="아니요" <?php if($musician === "아니요") echo "checked"; ?>>아니요</label>
                        </div>
                    </div>
                    
                    <div class="clear"></div>
                    
                    <div class="clear"></div>
                    <div class="bottom_line"> </div>
                    <div class="buttons">
                        <!-- 저장 버튼, 클릭 시 check_input() 함수 호출 -->
                        <img style="cursor:pointer" src="./img/button_save.gif" onclick="check_input()">&nbsp;
                        <!-- 초기화 버튼, 클릭 시 reset_form() 함수 호출 -->
                        <img id="reset_button" style="cursor:pointer" src="./img/button_reset.gif" onclick="reset_form()">
                    </div>
                </form>
            </div> <!-- join_box -->
            
            <div id="favorite_list">
                <h2>찜한 목록</h2>
                <ul>
                    <?php
                    // 데이터베이스에 다시 연결
                    $con = mysqli_connect("localhost", "user1", "12345", "music");

                    // 사용자가 찜한 목록을 조회하는 쿼리 실행
                    $sql_favorite = "SELECT * FROM favorites WHERE id='$id'";
                    $result_favorite = mysqli_query($con, $sql_favorite);

                    // 찜한 목록을 출력
                    while ($row_favorite = mysqli_fetch_array($result_favorite)) {
                        $mana_num = $row_favorite["mana_num"];
                        $subject = $row_favorite['subject'];
                        $regist_day = $row_favorite['regist_day'];

                        // 각 항목을 리스트 형태로 출력
                        echo "<li>$regist_day - <a href='managerboard_view.php?num=$mana_num'>$subject</a></li>";
                    }

                    // 데이터베이스 연결 종료
                    mysqli_close($con);
                    ?>
                </ul>
            </div>
            
            
        </div> <!-- main_content -->
    </section> 
    <!-- 푸터 부분에 footer.php를 포함 -->
    <footer>
        <?php include "footer.php";?>
    </footer>
</body>
</html>
<script src="./js/img_slide.js"></script>