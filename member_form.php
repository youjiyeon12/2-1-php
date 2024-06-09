<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?">
<link rel="stylesheet" type="text/css" href="./css/member.css?">
<link rel="stylesheet" type="text/css" href="./css/img_slide.css?version=1">
<header>
    <?php include "header.php";?> <!-- 헤더 부분 포함(가져오기) -->
</header>
<script>
   function check_input()
   {
    // 필수 입력 필드에 값이 비어 있는지 확인
    if (!document.member_form.id.value) {
        alert("아이디를 입력하세요!");    
        document.member_form.id.focus();
        return;
    }

    if (!document.member_form.pass.value) {
        alert("비밀번호를 입력하세요!");    
        document.member_form.pass.focus();
        return;
    }

    if (!document.member_form.pass_confirm.value) {
        alert("비밀번호확인을 입력하세요!");    
        document.member_form.pass_confirm.focus();
        return;
    }
    
    // 비밀번호와 비밀번호 확인이 일치하는지 확인
    if (document.member_form.pass.value != 
          document.member_form.pass_confirm.value) {
        alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
        document.member_form.pass.focus();
        document.member_form.pass.select();
        return;
    }


    if (!document.member_form.name.value) {
        alert("이름을 입력하세요!");    
        document.member_form.name.focus();
        return;
    }

    if (!document.member_form.age.value){
        alert("나이를 입력하세요!");
        document.member_form.age();
        return;
    }

    if (!document.member_form.phone.value){
        alert("전화번호를 입력하세요!");
        document.member_form.phone();
        return;
    }
    
    if (!document.member_form.address.value){
        alert("주소를 입력하세요!");
        document.member_form.address();
        return;
    }
    
    if (!document.member_form.gender.value){
        alert("성별을 클릭하세요!");
        document.member_form.gender();
        return;
    }
    
    // 체크박스 확인
    var hobbies = document.getElementsByName("hobby[]");
    var hobbyChecked = false;

    for (var i = 0; i < hobbies.length; i++) {
        if (hobbies[i].checked) {
            hobbyChecked = true;
            break; // 하나라도 체크된 것이 있으면 반복문 종료
        }
    }

    if (!hobbyChecked) {
        alert("하나 이상의 관심분야를 선택하세요!");
        return; // 입력값이 없으면 함수를 종료하고 폼을 제출하지 않음
    }
    
    if (!document.member_form.introduction.value){
        alert("가입인사/자기소개를 입력하세요!");
        document.member_form.introduction();
        return;
    }
    
    // 대표이미지를 선택했는지 확인
    var fileInput = document.member_form.upfile;
    if (!fileInput.value) {
        alert("대표이미지를 선택하세요!");
        fileInput.focus();
        return;
    }

    if (!document.member_form.musician.value){
        alert("뮤지션 여부를 클릭하세요!");
        document.member_form.musician();
        return;
    }
    
    // 모든 검증을 통과한 경우 폼 제출
    document.member_form.submit();
    }

   // 입력된 값들을 초기화하는 함수
    function reset_form() {
        document.member_form.id.value = "";  
        document.member_form.pass.value = "";
        document.member_form.pass_confirm.value = "";
        document.member_form.name.value = "";
        document.member_form.age.value = "";
        document.member_form.phone.value = "";
        document.member_form.address.value = "";
        document.member_form.introduction.value = "";
        // 성별 라디오 버튼 초기화
        var genders = document.getElementsByName("gender");
        for (var i = 0; i < genders.length; i++) {
            genders[i].checked = false;
        }

        // 뮤지션 여부 라디오 버튼 초기화
        var musicians = document.getElementsByName("musician");
        for (var i = 0; i < musicians.length; i++) {
            musicians[i].checked = false;
        }

        // 대표이미지 파일 입력 필드 초기화
        document.member_form.upfile.value = "";
        
        // 체크박스 초기화
        var checkboxes = document.getElementsByName("hobby[]");
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
        
        document.member_form.id.focus();
        
        return;
    }

   // 아이디 중복 체크를 위한 팝업 창 열기
    function check_id() {
        window.open("member_check_id.php?id=" + document.member_form.id.value,
            "IDcheck",
            "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
   }
</script>
</head>
<body> 
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
                <form  name="member_form" method="post" action="member_insert.php" enctype = "multipart/form-data">
                    <!-- 회원 가입을 위한 폼 -->
                    <h2>회원 가입</h2>
                    <div class="form id">
                        <div class="col1">아이디</div>
                        <div class="col2">
                            <input type="text" name="id"> <!-- 아이디 입력 필드 : member_form.id의 포커스 위치 --> 
                        </div>  
                        <div class="col3">
                            <!-- 아이디 중복 확인을 위한 버튼 -->
                            <a href="#"><img src="./img/check_id.gif" onclick="check_id()"></a>
                        </div>                 
                    </div>
                    <div class="clear"></div>

                    <!-- 비밀번호 입력 -->
                    <div class="form">
                        <div class="col1">비밀번호</div>
                        <div class="col2">
                            <input type="password" name="pass">
                        </div>                 
                    </div>
                    <div class="clear"></div>

                    <!-- 비밀번호 확인 -->
                    <div class="form">
                        <div class="col1">비밀번호 확인</div>
                        <div class="col2">
                            <input type="password" name="pass_confirm">
                        </div>                 
                    </div>
                    <div class="clear"></div>

                    <!-- 이름 입력 -->
                    <div class="form">
                        <div class="col1">이름</div>
                        <div class="col2">
                            <input type="text" name="name">
                        </div>                 
                    </div>
                    
                    <div class="clear"></div>

                    <!-- 나이 입력 -->
                    <div class="form">
                        <div class="col1">나이</div>
                        <div class="col2">
                            <input type="text" name="age">
                        </div>                 
                    </div>
                    
                    <div class="clear"></div>
                    
                    <!-- 전화번호 입력 -->
                    <div class="form">
                        <div class="col1">전화번호</div>
                        <div class="col2">
                            <input type="text" name="phone">
                        </div>                 
                    </div>      
                    
                    <div class="clear"></div>
                    
                    <!-- 주소 입력 -->
                    <div class="form">
                        <div class="col1">주소</div>
                        <div class="col2">
                            <input type="text" name="address">
                        </div>                 
                    </div>   
                    
                    <!-- 성별 -->
                    <div class="form">
                        <div class="col1">성별</div>
                        <div class="col4">
                            <label><input type="radio" name="gender" value="여">여</label>
                            <label><input type="radio" name="gender" value="남">남</label>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <!-- 취미/관심분야 -->
                    <div class="form">
                        <div class="col1">취미/관심분야</div>
                        <div class="col4">
                            <label><input type="checkbox" name="hobby[]" value="재즈">재즈</label>
                            <label><input type="checkbox" name="hobby[]" value="클래식">클래식</label>
                            <label><input type="checkbox" name="hobby[]" value="발라드">발라드</label>
                            <label><input type="checkbox" name="hobby[]" value="팝송">팝송</label>
                            <label><input type="checkbox" name="hobby[]" value="K-pop">K-pop</label>
                            <label><input type="checkbox" name="hobby[]" value="J-pop">J-pop</label>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <!-- 가입인사/자기소개 -->
                    <div class="form">
                        <div class="col1">가입인사/자기소개</div>
                        <div class="col2">
                            <textarea name="introduction" rows="5" cols="50"></textarea>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <!-- 대표이미지 -->
                    <div class="form">
                        <div class="col1">대표이미지</div>
                        <div class="col4">
                            <input type="file" name="upfile">
                        </div>
                    </div>
                    <div class="clear"></div>

                    <!-- 뮤지션 여부 -->
                    <div class="form">
                        <div class="col1">뮤지션 여부</div>
                        <div class="col4">
                            <label><input type="radio" name="musician" value="예">예</label>
                            <label><input type="radio" name="musician" value="아니요">아니요</label>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <!-- 하단 라인 -->
                    <div class="bottom_line"> </div>

                    <!-- 저장 및 초기화 버튼 -->
                    <div class="buttons">
                        <img style="cursor:pointer" src="./img/button_save.gif" onclick="check_input()">&nbsp;
                        <img id="reset_button" style="cursor:pointer" src="./img/button_reset.gif" onclick="reset_form()">
                    </div>
                </form>
            </div> <!-- join_box -->
        </div> <!-- main_content -->
    </section> 
    <footer>
        <div class="clear"></div>
        <?php include "footer.php";?>
    </footer>
</body>
</html>
<script src="./js/img_slide.js"></script>