<?php
    include_once "./util/db_con.php";

    $email = $_POST['email'];
    $password = $_POST['password'];
    
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
            session_start(); // 세션 시작. 본 예제는 DB에 사용자의 이메일, 닉네임과 함께 사용자 고유 번호를 가져왔습니다.
            $_SESSION["useremail"] = $row["email"]; // 사용자 이메일
            $_SESSION["usernickname"] = $row["nickname"]; // 사용자 닉네임
            $_SESSION["num"] = $row["num"]; // 사용자 DB내의 고유 번호(PRIMARY KEY)
            echo("
                <script>
                location.href = '/index.php'; // 메인 페이지로 이동
                </script>
                ");
        }
    }
?>