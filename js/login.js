// 입력 값 유효성을 검사하는 함수
function check_input() {
    // 아이디 입력란이 비어있는지 확인
    if (!document.login_form.id.value) {
        // 아이디를 입력하지 않았을 경우 알림 표시
        alert("아이디를 입력하세요");
        // 아이디 입력란에 포커스를 맞춤
        document.login_form.id.focus();
        // 함수 실행 종료
        return;
    }

    // 비밀번호 입력란이 비어있는지 확인
    if (!document.login_form.pass.value) {
        // 비밀번호를 입력하지 않았을 경우 알림 표시
        alert("비밀번호를 입력하세요");
        // 비밀번호 입력란에 포커스를 맞춤
        document.login_form.pass.focus();
        // 함수 실행 종료
        return;
    }
    
    // 모든 입력 값이 유효할 경우 로그인 폼을 제출(submit)
    document.login_form.submit();
}
