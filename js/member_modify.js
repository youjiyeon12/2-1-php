// 입력 값 검증 함수
function check_input() {
    // 비밀번호 입력란이 비어있는지 확인
    if (!document.member_form.pass.value) {
        alert("비밀번호를 입력하세요!");    
        document.member_form.pass.focus();
        return;
    }

    // 비밀번호 확인 입력란이 비어있는지 확인
    if (!document.member_form.pass_confirm.value) {
        alert("비밀번호 확인을 입력하세요!");    
        document.member_form.pass_confirm.focus();
        return;
    }

    // 이름 입력란이 비어있는지 확인
    if (!document.member_form.name.value) {
        alert("이름을 입력하세요!");    
        document.member_form.name.focus();
        return;
    }

    // 비밀번호와 비밀번호 확인 값이 일치하는지 확인
    if (document.member_form.pass.value != document.member_form.pass_confirm.value) {
        alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
        document.member_form.pass.focus();
        document.member_form.pass.select();
        return;
    }

    // 나이 입력란이 비어있는지 확인
    if (!document.member_form.age.value) {
        alert("나이를 입력하세요!");
        document.member_form.age.focus();
        return;
    }

    // 전화번호 입력란이 비어있는지 확인
    if (!document.member_form.phone.value) {
        alert("전화번호를 입력하세요!");
        document.member_form.phone.focus();
        return;
    }
    
    // 주소 입력란이 비어있는지 확인
    if (!document.member_form.address.value) {
        alert("주소를 입력하세요!");
        document.member_form.address.focus();
        return;
    }
    
    // 성별 선택 여부 확인
    if (!document.member_form.gender.value) {
        alert("성별을 클릭하세요!");
        document.member_form.gender.focus();
        return;
    }
    
    // 관심분야 체크박스 확인
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
    
    // 가입인사/자기소개 입력란이 비어있는지 확인
    if (!document.member_form.introduction.value) {
        alert("가입인사/자기소개를 입력하세요!");
        document.member_form.introduction.focus();
        return;
    }
    
    // 대표이미지 선택 여부 확인
    var fileInput = document.member_form.upfile;
    if (!fileInput.value) {
        alert("대표이미지를 선택하세요!");
        fileInput.focus();
        return;
    }

    // 뮤지션 여부 선택 여부 확인
    if (!document.member_form.musician.value) {
        alert("뮤지션 여부를 클릭하세요!");
        document.member_form.musician.focus();
        return;
    }
    
    // 모든 검증을 통과한 경우 폼 제출
    document.member_form.submit();
}

// 입력 내용 초기화 함수
function reset_form() {
    // 각 입력란의 값 초기화
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
    
    // 관심분야 체크박스 초기화
    var checkboxes = document.getElementsByName("hobby[]");
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });  
    
    // 아이디 입력란에 포커스 맞추기
    document.member_form.id.focus();

    return;
}
