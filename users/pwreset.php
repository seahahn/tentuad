<?php
include_once "../util/db_con.php";

$email = $_GET['email'];
$hash = $_GET['hash'];
$sql = "SELECT * FROM aduser WHERE email='$email'";
$result = mq($sql);
$row = mysqli_fetch_array($result);
$db_hash = $row['hashv'];

if($hash != $db_hash) {
    echo("
        <script>
        window.alert('비정상적인 접근입니다.')
        history.go(-1)
        </script>
        ");
}
?>

<!DOCTYPE HTML>
<!--
	Miniport by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>	
    <head>
		<title>TentuAd: AI 광고 어시스턴트</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/pwreset_chunk.css" />
		<link rel="stylesheet" href="../assets/css/app_ori.css" />
        <style type="text/css"> 
            a { text-decoration:none } 
        </style> 
	</head>	
    <body>
        <style type="text/css">html.hs-messages-widget-open.hs-messages-mobile,html.hs-messages-widget-open.hs-messages-mobile body{overflow:hidden!important;position:relative!important}html.hs-messages-widget-open.hs-messages-mobile body{height:100%!important;margin:0!important}#hubspot-messages-iframe-container{display:initial!important;z-index:2147483647;position:fixed!important;bottom:0!important}#hubspot-messages-iframe-container.widget-align-left{left:0!important}#hubspot-messages-iframe-container.widget-align-right{right:0!important}#hubspot-messages-iframe-container.internal{z-index:1016}#hubspot-messages-iframe-container.internal iframe{min-width:108px}#hubspot-messages-iframe-container .shadow-container{display:initial!important;z-index:-1;position:absolute;width:0;height:0;bottom:0;content:""}#hubspot-messages-iframe-container .shadow-container.internal{display:none!important}#hubspot-messages-iframe-container .shadow-container.active{width:400px;height:400px}#hubspot-messages-iframe-container iframe{display:initial!important;width:100%!important;height:100%!important;border:none!important;position:absolute!important;bottom:0!important;right:0!important;background:transparent!important}</style>
        <noscript>We're sorry, but TENTUPLAY doesn't work properly without JavaScript enabled. Please enable it to continue.</noscript>
        <div>
            <div id="viewport" class="blur1red">
                <!---->
                <div id="cover">
                    <!---->
                    <div id="content" class="centered">
                    <div data-v-49fc13f1="" class="card">
                        <div data-v-49fc13f1="" class="content">
                            <h1 data-v-49fc13f1="">TENTUPLAY</h1>
                            <h2 data-v-49fc13f1="">비밀번호 변경하기</h2>
                            <form data-v-49fc13f1="" id="formPw" name="formPw" method="POST" action="./pwreset_ok.php">
                                <input type="hidden" id="email" name="email" value="<?=$email?>">
                                <input type="hidden" id="hash" name="hash" value="<?=$hash?>">
                                <ul data-v-49fc13f1="" class="fieldset">
                                <li data-v-49fc13f1="">
                                    <input data-v-49fc13f1="" id="password" name="password" type="password" maxlength="16" class=""><label data-v-49fc13f1="">비밀번호</label>
                                    <p id="pw_shape" data-v-49fc13f1="" class="help">비밀번호는 8-16자여야 하며 적어도 한 개의 숫자 또는 특수문자를 포함해야 합니다.</p>
                                </li>
                                <li data-v-49fc13f1="">
                                    <input data-v-49fc13f1="" id="pw_confirm" name="pw_confirm" type="password" maxlength="16" class=""><label data-v-49fc13f1="">비밀번호 확인</label><!---->
                                    <span id="pw_check_msg" data-check="0"></span>
                                </li>
                                </ul>
                                <div data-v-49fc13f1="" class="center aligned">
                                    <button data-v-49fc13f1="" type="button" class="fluid primary button" onclick="check_input()">확인</button>
                                    <a data-v-49fc13f1="" href="login.php" class="fluid ghost button"> 취소 </a>
                                </div>
                            </form>
                        </div>
                        <!---->
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php include_once "../util/scripts.php" ?>
    <script>
        /* 필수 입력 채우지 않았을 경우 경고창 띄우기*/
        function check_input() {
            if(!$("#password").val()){
                alert("비밀번호를 입력해주세요.");
                $("#password").focus();
                return;
            }

            if(!$("#pw_confirm").val()){
                alert("비밀번호 확인을 입력해주세요.");
                $("#pw_confirm").focus();
                return;
            }

            if($("#password").val() != $("#pw_confirm").val()){
                alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");
                $("#password").focus();
                $("#password").select();
                return;
            }

            var regPw = /^.*(?=^.{8,16}$)([a-zA-Z]|[0-9]|[~!@#$%^&*()_+|<>?:{}]).*$/; // 비번 형식 검증식
            if(!regPw.test($("#password").val()) || !regPw.test($("#pw_confirm").val())) {
                alert("올바른 비밀번호 형식이 아닙니다.");
                return;
            }

            document.formPw.submit();
        }

        /* 비밀번호 입력 및 일치 여부 검증 */
        $(function(){
            $("#pw_confirm").blur(function(){
                var regPw = /^.*(?=^.{8,16}$)([a-zA-Z]|[0-9]|[~!@#$%^&*()_+|<>?:{}]).*$/; // 비번 형식 검증식
                // var regPw = /^.*(?=^.{8,16}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/; // 비번 형식 검증식
                if($("#password").val()==""){
                    $("#pw_check_msg").html("비밀번호를 입력해주세요.").css("color", "red").attr("data-check", "0");
                    $("#password").focus();
                } else if($(this).val()==""){            
                    $("#pw_check_msg").html("비밀번호 확인을 입력해주세요.").css("color", "red").attr("data-check", "0");
                    $(this).focus();
                }else if(!regPw.test(($(this)).val()) || !regPw.test($("#password").val())) {
                    console.log(regPw.test(($(this)).val()));
                    $("#pw_shape").css("color", "red").attr("data-check", "0");
                    $("#pw_check_msg").html("올바른 비밀번호 형식이 아닙니다.").css("color", "red").attr("data-check", "0");
                } else if($(this).val() != $("#password").val()){
                    $("#pw_shape").css("color", "silver").attr("data-check", "0");
                    $("#pw_check_msg").html("비밀번호가 일치하지 않습니다.").css("color", "red").attr("data-check", "0");
                } else {    
                    $("#pw_shape").css("color", "silver").attr("data-check", "0");
                    $("#pw_check_msg").html("비밀번호가 일치합니다.").css("color", "blue").attr("data-check", "1");
                }
            });
        });
    </script>
</html>