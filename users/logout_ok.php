<?php
    session_start();
    unset($_SESSION["email"]);
    unset($_SESSION["username"]);
    unset($_SESSION["role"]);
    unset($_SESSION["idx"]);
    echo("
        <script>
            alert('로그아웃 되었습니다.');
            location.href = 'login.php'
        </script>")
?>