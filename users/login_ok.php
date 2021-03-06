<?php
    include_once "../util/db_con.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(isset($_POST['remember_info']) && $_POST['remember_info'] == ('checked' || 'on')) {
        // '이메일 저장하기' 체크한 경우 쿠키 생성
        $remember_info = $_POST['remember_info'];
        setcookie("cookieemail", $email, time() + 86400 * 30); // 쿠키에 이메일 입력값 저장
        setcookie("remember_info", $remember_info, time() + 86400 * 30); // 쿠키에 체크박스 체크 여부 저장
        
    } else if(!isset($_POST['remember_info']) || $_POST['remember_info'] == ''){
        setcookie("cookieemail", "", time()-3600);
        setcookie("remember_info", "", time()-3600);
    }

    $sql = "SELECT * FROM aduser WHERE email='$email'";
    $result = mq($sql);

    $num_match = mysqli_num_rows($result);

    if(!$num_match){
        echo("
            <script>
            window.alert('등록되지 않은 이메일입니다.')
            history.go(-1)
            </script>
            ");
    } else {
        $row = mysqli_fetch_array($result);
        $db_userpw = $row['pw']; // DB에 저장된 사용자의 비밀번호 정보
        $db_active = $row['active']; // 이메일 인증(계정 활성화) 여부

        if(!password_verify($password, $db_userpw)){
            echo("
                <script>
                window.alert('비밀번호가 틀립니다.')
                history.go(-1)
                </script>
                ");
        } else if($db_active != 1) {
            echo("
                <script>
                window.alert('이메일 인증을 해주세요.')
                history.go(-1)
                </script>
                ");
        } else {
            session_start(); // 세션 시작
            $_SESSION["email"] = $row["email"]; // 사용자 이메일
            $_SESSION["username"] = $row["username"]; // 사용자 닉네임
            $_SESSION["idx"] = $row["idx"]; // DB의 사용자 고유 번호(PRIMARY KEY)
            echo("
                <script>
                location.href = '../info/dashboard.php'; // 광고주(0)->광고 관리 / 게임사(1)->광고 수익 조회 페이지로 이동
                </script>
                ");
        }
    }
?>