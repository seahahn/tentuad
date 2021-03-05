<?php
include_once "../util/config.php";
include_once "../util/db_con.php";

$sql = "SELECT * FROM aduser WHERE email='$email'";
$result = mq($sql);
$userinfo = mysqli_fetch_array($result);
$usergroup = $userinfo['usergroup'];
switch($usergroup){
    case 0:
        $usergroup_show = '광고주';
        break;
    case 1:
        $usergroup_show = '게임사';
        break;
}
$phone = $userinfo['phone'];
?>

<!DOCTYPE HTML>
<html>	
    <head>
		<title>TentuAd: AI 광고 어시스턴트</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/bootstrap.css" />
		<link rel="stylesheet" href="../assets/css/dashboard.css" />
	</head>	
    <body>
        <style type="text/css">html.hs-messages-widget-open.hs-messages-mobile,html.hs-messages-widget-open.hs-messages-mobile body{overflow:hidden!important;position:relative!important}html.hs-messages-widget-open.hs-messages-mobile body{height:100%!important;margin:0!important}#hubspot-messages-iframe-container{display:initial!important;z-index:2147483647;position:fixed!important;bottom:0!important}#hubspot-messages-iframe-container.widget-align-left{left:0!important}#hubspot-messages-iframe-container.widget-align-right{right:0!important}#hubspot-messages-iframe-container.internal{z-index:1016}#hubspot-messages-iframe-container.internal iframe{min-width:108px}#hubspot-messages-iframe-container .shadow-container{display:initial!important;z-index:-1;position:absolute;width:0;height:0;bottom:0;content:""}#hubspot-messages-iframe-container .shadow-container.internal{display:none!important}#hubspot-messages-iframe-container .shadow-container.active{width:400px;height:400px}#hubspot-messages-iframe-container iframe{display:initial!important;width:100%!important;height:100%!important;border:none!important;position:absolute!important;bottom:0!important;right:0!important;background:transparent!important}</style>
        <noscript>We're sorry, but TENTUPLAY doesn't work properly without JavaScript enabled. Please enable it to continue.</noscript>
        <div>
            <div id="viewport" class="blur1red">
                <?php include_once "../fragment/sidebar.php"; ?>

                <div id="main">
                    <?php include_once "../fragment/profile_icon.php";?>

                    <div class="container">
                        <h2 class="page headline">내 프로필</h2>
                        
                        <div data-v-0a969038="" class="tiny grid bg-white p-5">
                            <form data-v-0a969038="" id="profile" name="profile" method="POST" action="./profile_ok.php">
                                <ul data-v-0a969038="" class="fieldset">
                                    <li data-v-0a969038="" data-children-count="1"><input data-v-0a969038="" type="text" value="<?=$usergroup_show?>" maxlength="50" readonly="readonly"><label data-v-0a969038="">회원 구분</label></li>
                                    <li data-v-0a969038="" data-children-count="1"><input data-v-0a969038="" type="email" value="<?=$email?>" maxlength="50" readonly="readonly"><label data-v-0a969038="">이메일</label></li>
                                    <li data-v-0a969038="" data-children-count="1">
                                        <input data-v-0a969038="" id="password" name="password" type="password" maxlength="16" class="" data-kwimpalastatus="alive" data-kwimpalaid="1614837893747-15"><label data-v-0a969038="">새 비밀번호</label>
                                        <p data-v-0a969038="" id="pw_shape" class="help">비밀번호는 8-16자여야 하며 적어도 한 개의 숫자 또는 특수문자를 포함해야 합니다.</p>
                                    </li>
                                    <li data-v-0a969038="" data-children-count="1">
                                        <input data-v-0a969038="" id="pw_confirm" name="pw_confirm" type="password" maxlength="16" class="" data-kwimpalastatus="alive" data-kwimpalaid="1614837893747-16"><label data-v-0a969038="">비밀번호 확인</label><!---->
                                        <span id="pw_check_msg" data-check="0" style="font-size:.75rem"></span>
                                    </li>
                                    <li data-v-0a969038="" data-children-count="1">
                                        <input data-v-0a969038="" id="name" name="name" type="text" value="<?=$username?>" class="" data-kwimpalastatus="alive" data-kwimpalaid="1614837893747-18"><label data-v-0a969038="">이름</label><!---->
                                    </li>
                                    <li data-v-0a969038="" data-children-count="1">
                                        <input data-v-0a969038="" id="phone" name="phone" type="tel" class="" value="<?=$phone?>" ><label data-v-0a969038="">연락처 <span data-v-0a969038="" class="condensed">(선택)</span></label><!---->
                                    </li>
                                </ul>
                                <div data-v-0a969038="" class="left aligned"><button data-v-0a969038="" type="button" class="primary button" onclick="check_input();">저장</button><span data-v-0a969038="" class="ghost button" onclick="location.href='../info/dashboard.php'">취소</span></div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php include_once "../util/scripts.php" ?>
        <script>
            /* 필수 입력 채우지 않았을 경우 경고창 띄우기*/
            function check_input() {
                // if(!$("#password").val() && $("#pw_confirm").val()){
                //     alert("비밀번호를 입력해주세요.");
                //     $("#password").focus();
                //     return;
                // }

                // if($("#password").val() && !$("#pw_confirm").val()){
                //     alert("비밀번호 확인을 입력해주세요.");
                //     $("#pw_confirm").focus();
                //     return;
                // }

                // if(($("#password").val() && $("#pw_confirm").val()) && ($("#password").val() != $("#pw_confirm").val())){
                //     alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");
                //     $("#password").focus();
                //     $("#password").select();
                //     return;
                // }

                // if(($("#password").val() && $("#pw_confirm").val()) && (!$("#pw_check_msg").attr("data-check") != "1")){
                //     alert("올바른 비밀번호 형식이 아닙니다.");
                //     $("#password").focus();
                //     return;
                // }

                // if(!$("#name").val()){
                //     alert("이름을 입력해주세요.");
                //     $("#name").focus();
                //     return;
                // }

                // if(!$("#password").val()){
                //     alert("비밀번호를 입력해주세요.");
                //     $("#password").focus();
                //     return;
                // }

                // if(!$("#pw_confirm").val()){
                //     alert("비밀번호 확인을 입력해주세요.");
                //     $("#pw_confirm").focus();
                //     return;
                // }

                // if($("#password").val() != $("#pw_confirm").val()){
                //     alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");
                //     $("#password").focus();
                //     $("#password").select();
                //     return;
                // }

                // if(!$("#pw_check_msg").attr("data-check") != "1"){
                //     alert("올바른 비밀번호 형식이 아닙니다.");
                //     $("#password").focus();
                //     return;
                // }

                // if(!$("#name").val()){
                //     alert("이름을 입력해주세요.");
                //     $("#name").focus();
                //     return;
                // }
                var regPw = /^((?=.*\d)|(?=.*\W)).{8,16}$/; // 비번 형식 검증식
                // var regPw = /^.*(?=^.{8,16}$)([a-zA-Z]|[0-9]|[~!@#$%^&*()_+|<>?:{}]).*$/; // 비번 형식 검증식
                if($("#password").val()==""){
                        $("#pw_check_msg").html("비밀번호를 입력해주세요.").css("color", "red").attr("data-check", "0");
                        $("#pw_shape").css("color", "red").attr("data-check", "0");
                        $("#password").focus();
                        return;
                    } else if($("#pw_confirm").val()==""){            
                        $("#pw_check_msg").html("비밀번호 확인을 입력해주세요.").css("color", "red").attr("data-check", "0");
                        $("#pw_shape").css("color", "red").attr("data-check", "0");
                        $("#pw_confirm").focus();
                        return;
                    } else if($("#pw_confirm").val() != $("#password").val()){
                        $("#pw_shape").css("color", "silver").attr("data-check", "0");
                        $("#pw_check_msg").html("비밀번호가 일치하지 않습니다.").css("color", "red").attr("data-check", "0");
                        return;
                    } else if(!regPw.test(($("#pw_confirm")).val()) || !regPw.test($("#password").val())) {
                        $("#pw_shape").css("color", "red").attr("data-check", "0");
                        $("#pw_check_msg").html("올바른 비밀번호 형식이 아닙니다.").css("color", "red").attr("data-check", "0");
                        return;
                    } else {
                        $("#pw_shape").css("color", "silver").attr("data-check", "0");
                        $("#pw_check_msg").html("").css("color", "blue").attr("data-check", "1");
                    }

                document.profile.submit();
            }

            /* 비밀번호 입력 및 일치 여부 검증 */
            $(function(){
                $("#pw_confirm").blur(function(){
                    var regPw = /^((?=.*\d)|(?=.*\W)).{8,16}$/; // 비번 형식 검증식
                    // var regPw = /^.*(?=^.{8,16}$)([a-zA-Z]|[0-9]|[~!@#$%^&*()_+|<>?:{}]).*$/; // 비번 형식 검증식
                    // var regPw = /^.*(?=^.{8,16}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/; // 비번 형식 검증식
                    if($("#password").val()==""){
                        $("#pw_check_msg").html("비밀번호를 입력해주세요.").css("color", "red").attr("data-check", "0");
                        $("#pw_shape").css("color", "silver").attr("data-check", "0");
                        $("#password").focus();
                    } else if($(this).val()==""){            
                        $("#pw_check_msg").html("비밀번호 확인을 입력해주세요.").css("color", "red").attr("data-check", "0");
                        $("#pw_shape").css("color", "silver").attr("data-check", "0");
                        $(this).focus();
                    } else if($(this).val() != $("#password").val()){
                        $("#pw_shape").css("color", "silver").attr("data-check", "0");
                        $("#pw_check_msg").html("비밀번호가 일치하지 않습니다.").css("color", "red").attr("data-check", "0");
                    } else if(!regPw.test(($(this)).val()) || !regPw.test($("#password").val())) {
                        $("#pw_shape").css("color", "red").attr("data-check", "0");
                        $("#pw_check_msg").html("올바른 비밀번호 형식이 아닙니다.").css("color", "red").attr("data-check", "0");
                    } else {    
                        $("#pw_shape").css("color", "silver").attr("data-check", "0");
                        $("#pw_check_msg").html("비밀번호가 일치합니다.").css("color", "blue").attr("data-check", "1");
                    }
                });
            });
        </script>
    </body>
</html>