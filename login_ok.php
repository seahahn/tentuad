<?php
    include_once "./util/db_con.php";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "select * from user where email='$email'";
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

        if(!password_verify($password, $db_userpw)){
            echo("
                <script>
                window.alert('비밀번호가 틀립니다.')
                history.go(-1)
                </script>
                ");
        } else {
            session_start(); // 세션 시작
            $_SESSION["email"] = $row["email"]; // 사용자 이메일
            $_SESSION["username"] = $row["username"]; // 사용자 닉네임
            $_SESSION["idx"] = $row["idx"]; // 사용자 DB내의 고유 번호(PRIMARY KEY)
            echo("
                <script>
                location.href = 'index.php'; // 광고주(0)->광고 관리 / 게임사(1)->광고 수익 조회 페이지로 이동
                </script>
                ");
        }
    }
?>