<?php
include_once "../util/config.php";
include_once "../util/db_con.php";

?>

<!DOCTYPE HTML>
<html>	
    <head>
		<title>TentuAd: AI 광고 어시스턴트</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/bootstrap.css" />
		<!-- <link rel="stylesheet" href="../assets/css/login_chunk.css" /> -->
		<link rel="stylesheet" href="../assets/css/dashboard.css" />
	</head>	
    <body>
        <style type="text/css">html.hs-messages-widget-open.hs-messages-mobile,html.hs-messages-widget-open.hs-messages-mobile body{overflow:hidden!important;position:relative!important}html.hs-messages-widget-open.hs-messages-mobile body{height:100%!important;margin:0!important}#hubspot-messages-iframe-container{display:initial!important;z-index:2147483647;position:fixed!important;bottom:0!important}#hubspot-messages-iframe-container.widget-align-left{left:0!important}#hubspot-messages-iframe-container.widget-align-right{right:0!important}#hubspot-messages-iframe-container.internal{z-index:1016}#hubspot-messages-iframe-container.internal iframe{min-width:108px}#hubspot-messages-iframe-container .shadow-container{display:initial!important;z-index:-1;position:absolute;width:0;height:0;bottom:0;content:""}#hubspot-messages-iframe-container .shadow-container.internal{display:none!important}#hubspot-messages-iframe-container .shadow-container.active{width:400px;height:400px}#hubspot-messages-iframe-container iframe{display:initial!important;width:100%!important;height:100%!important;border:none!important;position:absolute!important;bottom:0!important;right:0!important;background:transparent!important}</style>
        <noscript>We're sorry, but TENTUPLAY doesn't work properly without JavaScript enabled. Please enable it to continue.</noscript>
        <div>
            <div id="viewport" class="blur1red">
                <aside id="sidebar">
                    <div class="sidebar">
                    <nav id="gnb">
                        <!-- 사이드바 헤더 부분 시작-->
                        <h2 class="hidden">Menu</h2>
                        <div class="border-bottom">
                            <a href="dashboard.php" class="active">
                                <h1 class="logo">TENTUPLAY</h1>
                                <h2 class="text-center mb-3">광고주 센터</h2>
                            </a>
                        </div>
                        <!-- 사이드바 헤더 부분 끝-->

                        <!-- 사이드바 내용 부분 시작-->
                        <ul class="global navigation">
                            <li>
                                <span data-v-4bcec590="" class="exact active">광고 목록</span>
                                <div aria-expanded="true">
                                <ul class="submenu level one">
                                    <li data-v-4bcec590="">
                                        <a data-v-4bcec590="" href="#" aria-current="page" class=""><span data-v-4bcec590="">광고 1 </span></a>
                                    </li>
                                    <li data-v-4bcec590="">
                                        <a data-v-4bcec590="" href="#" class=""><span data-v-4bcec590="">광고 2</span></a>
                                    </li>
                                </ul>
                                </div>
                            </li>
                        </ul>
                        <!-- 사이드바 내용 부분 끝-->
                        <button type="button" class="btn btn-lg btn-warning mt-3 justify-content-center w-100 rounded-0" onclick="location.href='add.php'"><span class="text-light">+ 광고 만들기</span></button>
                    </nav>
                    </div>
                </aside>

                <div id="main">
                    <?php include_once "../fragment/profile_icon.php";?>

                    <div class="container">
                        <h2 class="page headline">내 프로필</h2>
                        
                        <div data-v-0a969038="" class="tiny grid bg-white p-5">
                            <form data-v-0a969038="">
                                <ul data-v-0a969038="" class="fieldset">
                                    <li data-v-0a969038="" data-children-count="1"><input data-v-0a969038="" type="email" value="<?=$email?>" maxlength="50" readonly="readonly"><label data-v-0a969038="">이메일</label></li>
                                    <li data-v-0a969038="" data-children-count="1">
                                        <input data-v-0a969038="" type="password" maxlength="16" class="" data-kwimpalastatus="alive" data-kwimpalaid="1614837893747-15"><label data-v-0a969038="">새 비밀번호</label>
                                        <p data-v-0a969038="" class="help">비밀번호는 8-16자여야 하며 적어도 한 개의 숫자 또는 특수문자를 포함해야 합니다.</p>
                                    </li>
                                    <li data-v-0a969038="" data-children-count="1">
                                        <input data-v-0a969038="" type="password" maxlength="16" class="" data-kwimpalastatus="alive" data-kwimpalaid="1614837893747-16"><label data-v-0a969038="">비밀번호 확인</label><!---->
                                    </li>
                                    <li data-v-0a969038="" data-children-count="1">
                                        <input data-v-0a969038="" type="text" value="<?=$username?>" class="" data-kwimpalastatus="alive" data-kwimpalaid="1614837893747-18"><label data-v-0a969038="">이름</label><!---->
                                    </li>
                                    <li data-v-0a969038="" data-children-count="1">
                                        <input data-v-0a969038="" type="tel" class=""><label data-v-0a969038="">연락처 <span data-v-0a969038="" class="condensed">(선택)</span></label><!---->
                                    </li>
                                </ul>
                                <div data-v-0a969038="" class="left aligned"><button data-v-0a969038="" type="submit" class="primary button">저장</button><span data-v-0a969038="" class="ghost button">취소</span></div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php include_once "../util/scripts.php" ?>
    </body>
</html>