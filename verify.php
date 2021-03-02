<?php
include_once "./util/db_con.php";

$email = $_GET['email'];
$hash = $_GET['hash'];
$sql = "SELECT * FROM aduser WHERE email='$email'";
$result = mq($sql);
$row = mysqli_fetch_array($result);
$db_hash = $row['hashv'];

if($hash == $db_hash) {
    mq("UPDATE aduser SET
                hashv = '',
                active = '1';
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
		<link rel="stylesheet" href="assets/css/verify_chunk.css" />
		<link rel="stylesheet" href="assets/css/app_ori.css" />
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
                    <div data-v-84f99162="" class="card">
                        <div data-v-84f99162="" class="content">
                            <h1 data-v-84f99162="">TENTUPLAY</h1>
                            <!---->
                            <div data-v-84f99162="">
                                <h2 data-v-84f99162="">환영합니다!</h2>
                                <p data-v-84f99162="">이메일 인증이 완료되었습니다.</p>
                                <div data-v-84f99162="" class="center aligned" style="margin-top: 2rem;"><a data-v-84f99162="" href="login.php" class="fluid primary button"> 로그인 </a></div>
                            </div>
                            <!---->
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>