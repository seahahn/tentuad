<!-- 세션 관리 -->
<?php
    session_start();
    if (isset($_SESSION["email"])) {
        $email = $_SESSION["email"];
    }else{
        $email = "";
    }
    
    if (isset($_SESSION["username"])){
        $username = $_SESSION["username"];
    }else{
        $username = "";
    }
    
    if (isset($_SESSION["role"])){ // 사용자, 관리자 구분 용도
        $role = $_SESSION["role"];
    }else{
        $role = "";
    }
    
    if (isset($_SESSION["idx"])){ // DB상의 사용자 고유 번호
        $idx = $_SESSION["idx"];
    }else{
        $idx = "";
    }
?>