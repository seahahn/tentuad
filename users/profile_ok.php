<?php
    include_once "../util/db_con.php";
    include_once "../util/config.php";

    $sql = "SELECT * FROM aduser WHERE email='$email'";
    $result = mq($sql);
    $row = mysqli_fetch_array($result);
    $name = $_POST['name'];

    // 비밀번호 변경(받은 값 그대로 변경함)
    $pw = $_POST['password'];
    mq("UPDATE aduser SET pw='".$pw."' WHERE idx='$idx'");
    
    if(!empty($_POST['phone'])){
        // 연락처가 들어오면 변경
        $phone = $_POST['phone'];
        mq("UPDATE aduser SET phone='".$phone."' WHERE idx='$idx'");
    }
    
    // 이름 변경(받은 값 그대로 변경함)
    mq("UPDATE aduser SET username='".$name."' WHERE idx='$idx'");
    

    session_start(); // 세션 시작
    $_SESSION["email"] = $email; // 사용자 이메일
    $_SESSION["username"] = $name; // 사용자 닉네임
    $_SESSION["idx"] = $idx; // DB의 사용자 고유 번호(PRIMARY KEY)
    echo("
        <script>
        alert('회원 정보가 수정되었습니다.');
        location.href = '../users/profile.php';
        </script>
        ");
    
    
?>