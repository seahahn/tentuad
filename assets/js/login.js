function check_input() {
    // 로그인 창에서 Login 버튼 클릭 시 작동시킬 기능
    if (!document.formLogin.email.value){
        alert("이메일을 입력해주세요.");
        document.formLogin.email.focus();
        return;
    }

    if (!document.formLogin.password.value){
        alert("비밀번호를 입력해주세요.");
        document.formLogin.password.focus();
        return;
    }

    document.formLogin.submit();
}