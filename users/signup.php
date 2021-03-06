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
        <link rel="stylesheet" href="../assets/css/bootstrap.css" />
		<link rel="stylesheet" href="../assets/css/signup_chunk.css" />
		<link rel="stylesheet" href="../assets/css/app.css" />
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
                    <div data-v-65f80472="" class="card">
                        <div data-v-65f80472="" class="content">
                            <h1 data-v-65f80472="">TENTUPLAY</h1>
                            <h2 data-v-65f80472="" class="capitalized">회원가입</h2>
                        <!-- 회원가입 양식 시작 -->
                            <form data-v-65f80472="" id="formSignupKR" name="formSignupKR" method="POST" action="./signup_ok.php">
                                <ul data-v-65f80472="" class="fieldset">
                                <li data-v-65f80472="">
                                    <input data-v-65f80472="" type="radio" id="usergroup0" name="usergroup" value="0" style="margin-right:5px">광고주
                                    <span style="margin-right:50px"></span>
                                    <input data-v-65f80472="" type="radio" id="usergroup1" name="usergroup" value="1" style="margin-right:5px">게임사
                                    <label data-v-65f80472="">회원 구분</label><!---->
                                </li>
                                <li data-v-65f80472="">
                                    <input data-v-65f80472="" id="email" name="email" type="email" maxlength="50" class="">
                                    <label data-v-65f80472="">이메일</label><!---->
                                    <span id="email_check_msg" data-check="0"></span>
                                </li>
                                <li data-v-65f80472="">
                                    <input data-v-65f80472="" id="password" name="password" type="password" maxlength="16" class="">
                                    <label data-v-65f80472="">비밀번호</label>
                                    <p id="pw_shape" data-v-65f80472="" class="help">비밀번호는 8-16자여야 하며 적어도 한 개의 숫자 또는 특수문자를 포함해야 합니다.</p>
                                </li>
                                <li data-v-65f80472="">
                                    <input data-v-65f80472="" id="pw_confirm" name="pw_confirm" type="password" maxlength="16" class=""><label data-v-65f80472="">비밀번호 확인</label><!---->
                                    <span id="pw_check_msg" data-check="0"></span>
                                </li>
                                <li data-v-65f80472="">
                                    <input data-v-65f80472="" id="name" name="name" type="text" class=""><label data-v-65f80472="">이름</label><!---->
                                </li>
                                <li data-v-65f80472="">
                                    <input data-v-65f80472="" id="phone" name="phone" type="tel" class=""><label data-v-65f80472="">연락처 <span data-v-65f80472="" class="condensed">(선택)</span></label><!---->
                                </li>
                                <li data-v-65f80472="">
                                    <!-- <div data-v-cd70975a="" data-v-65f80472="" class="checkbox">
                                        <input data-v-cd70975a="" type="checkbox" id="checkbox-agree_term" value="1">
                                        <label data-v-cd70975a="" for="checkbox-agree_term" class="">
                                            <span data-v-cd70975a="">
                                            <svg data-v-cd70975a="" width="12" height="10" viewbox="0 0 12 0">
                                                <polyline data-v-cd70975a="" points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg>
                                            </span>
                                            <span data-v-cd70975a="" class="align-middle">텐투애드 <a href="https://tentuplay.io/terms/" target="_blank">이용약관</a>과 <a href="https://tentuplay.io/privacy/" target="_blank">개인정보처리방침</a>에 동의합니다</span>
                                        </label>
                                    </div> -->

                                    <div class="form-check d-flex">
                                        <input class="form-check-input me-2" type="checkbox" value="1" id="checkbox-agree_term">
                                        <!-- <label class="form-check-label d-flex align-content-center" for="no_budget"> -->
                                            <span data-v-cd70975a="" class="align-self-center">텐투애드 <a href="https://tentuplay.io/terms/" target="_blank">이용약관</a>과 <a href="https://tentuplay.io/privacy/" target="_blank">개인정보처리방침</a>에 동의합니다</span>
                                        <!-- </label> -->
                                    </div>
                                    <p data-v-65f80472="" class="error"></p>
                                </li>
                                </ul>
                                <div data-v-65f80472="" class="center aligned"><button data-v-65f80472="" type="button" class="fluid primary button" onclick="check_input()">회원가입</button></div>
                                <p data-v-65f80472="" class="center aligned sub"> 이미 계정이 있으신가요? <a data-v-65f80472="" href="login.php" class="sub"> 로그인 </a></p>
                            </form>
                        <!-- 회원가입 양식 끝 -->
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once "../util/scripts.php" ?>
        <script src="../assets/js/signup.js"></script> <!-- 회원가입 기능을 위한 스크립트-->

    </body>
</html>