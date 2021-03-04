<?php
include_once "../util/db_con.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../PHPMailer/src/PHPMailer.php";
require "../PHPMailer/src/SMTP.php";
require "../PHPMailer/src/Exception.php";


$email = $_POST['email'];
$hash = md5( rand(0,1000) ); // 비번 변경 위한 해쉬값 생성(해쉬값으로 사용자 판별)
// Generate random 32 character hash and assign it to a local variable.
// Example output: f4552671f8909587cf485ea990207f3b

$sql = "SELECT * FROM aduser WHERE email='$email'";
$result = mq($sql);
$row = mysqli_fetch_array($result);
$name = $row['username'];

$num_match = mysqli_num_rows($result);

if(!$num_match){
    echo("
        <script>
        window.alert('등록되지 않은 이메일입니다.')
        history.go(-1)
        </script>
        ");
} else {
    mq("UPDATE aduser SET
                hashv = '$hash'
                ");
}

$mail = new PHPMailer(true);

try {

  // 서버세팅
  $mail -> SMTPDebug = false;    // 디버깅 설정
  $mail -> isSMTP();        // SMTP 사용 설정

  $mail -> Host = "smtp.gmail.com";                // email 보낼때 사용할 서버를 지정
  $mail -> SMTPAuth = true;                        // SMTP 인증을 사용함
  $mail -> Username = "tentuad.noreply@gmail.com";    // 메일 계정
  $mail -> Password = "Teamnova123!";                // 메일 비밀번호
  $mail -> SMTPSecure = "ssl";                    // SSL을 사용함
  $mail -> Port = 465;                            // email 보낼때 사용할 포트를 지정
  $mail -> CharSet = "utf-8";                        // 문자셋 인코딩

  // 보내는 메일
  $mail -> setFrom("tentuad.noreply@gmail.com", "no-reply");

  // 받는 메일    
  $mail -> addAddress("$email", "$name");

  // 메일 내용
  $mail -> isHTML(true);                                               // HTML 태그 사용 여부
  $mail -> Subject = "[텐투애드] 비밀번호 재설정 안내";              // 메일 제목
  $mail -> Body = '
  <table class="wrapper" style="border-collapse: collapse;table-layout: fixed;min-width: 320px;width: 100%;background-color: #f8f8f9;" cellpadding="0" cellspacing="0"><tbody><tr><td>

  <div>
    <div style="margin: 0 auto;max-width: 560px;min-width: 280px; width: 280px;width: calc(28000% - 167440px);">
      <div style="border-collapse: collapse;display: table;width: 100%;">
        <div style="display: table-cell;Float: left;font-size: 12px;line-height: 19px;max-width: 280px;min-width: 140px; width: 140px;width: calc(14000% - 78120px);padding: 10px 0 5px 0;color: #b8b8b8;font-family:sans-serif;"></div>
        <div style="display: table-cell;Float: left;font-size: 12px;line-height: 19px;max-width: 280px;min-width: 139px; width: 139px;width: calc(14100% - 78680px);padding: 10px 0 5px 0;text-align: right;color: #b8b8b8;font-family:sans-serif;"></div>
      </div>
    </div>
  </div>

  <div>
    <div style="margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px);word-wrap:break-word;word-break:break-word">
      <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:sans-serif;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)">

          <div align="left" style="font-size:12px;font-style:normal;font-weight:normal;line-height:19px;margin-left:20px;margin-right:20px;margin-top:40px">
            <img style="border:0;display:block;height:auto;width:100%;max-width:150px" alt="" width="150" src="https://tentuplay.io/static/images/common/logo_dark.png" tabindex="0" loading="lazy">
            <div dir="ltr" style="opacity: 0.01; left: 1063px; top: 406px;">
              <div tabindex="0">
                <div></div>
              </div>
            </div>
            <div dir="ltr" style="opacity: 0.01;"></div>
          </div>

          <!-- 제목 -->
          <div align="center" style="font-size:12px;font-style:normal;font-weight:normal;line-height:19px;margin-left:20px;margin-right:20px;margin-top:15px">
              <div style="line-height:1px;font-size:1px;background-color: #0b1121;">&nbsp;</div>
              <div style="margin-top: 50px; margin-bottom: 0; text-align:center;font-family:sans-serif;line-height:1;font-size: 36px;font-style: normal;font-stretch: normal;letter-spacing: -1.2px;color:#333333">
                <strong style="line-height:1">비밀번호 재설정 안내</strong>
              </div>
          </div>

          <!-- 내용 -->
          <div style="margin-left:20px;margin-right:20px">
            <div>
              <p align="center" style="margin-top:32px;margin-bottom:16px;font-family:sans-serif;color:#0b1121;font-size: 14px;font-style: normal;font-stretch: normal;letter-spacing: -0.6px;">
                안녕하세요 '.$name.' 님,<br>
                텐투플레이 비밀번호를 아래에서 새로 설정할 수 있습니다.
              </p>
              <p align="center" style="margin-top:32px;margin-bottom:16px;font-family:sans-serif;color:#0b1121;font-size:14px;font-style:normal;font-stretch:normal;letter-spacing:-0.6px;">
                비밀번호를 변경하고 싶지 않거나 본인이 요청한 것이 아닌 경우, 이 메일을 무시하고 삭제하시기 바랍니다.<br>
                보안을 위해 이메일을 누구에게도 공유하지 마세요. 비밀번호 변경은 30분 이내에 가능합니다.
              </p>
            </div>
          </div>

          <div style="margin-left:20px;margin-right:20px">
            <div style="margin-bottom:20px;text-align:center"></div>
          </div>

          <!-- 버튼 -->
          <div style="margin-bottom:20px;text-align:center">
            <u></u><a style="border:1px #ff6900 solid;border-radius:30px;display:inline-block;font-size:14px;font-weight:bold;line-:1;padding:12px 24px;text-align:center;text-decoration:none!important;color:#ffffff!important;background-color:#ff6900;font-family:sans-serif" href="http://52.79.143.149/ad/pwreset.php?email='.$email.'&hash='.$hash.'" target="_blank" rel="noreferrer noopener">비밀번호 변경하러 가기</a><u></u>
          </div>

        </div>

        <div style="margin-left:20px;margin-right:20px">
          <div style="line-height:10px;font-size:1px">&nbsp;</div>
          <div style="line-height:10px;font-size:1px">&nbsp;</div>
          <div style="line-height:10px;font-size:1px">&nbsp;</div>
        </div>

      </div>

      <!-- 내용 푸터 -->
      <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:sans-serif;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px);background-color: #fff1e8;">
        <div style="margin-left:20px;margin-right:20px;">

          <div style="background-color: #fff1e8;">
            <div style="line-height:10px;font-size:1px">&nbsp;</div>
            <div style="line-height:10px;font-size:1px">&nbsp;</div>
            <p style="margin-top:0;margin-bottom:0;text-align:center;color:rgba(0,0,0,0.65);font-family:sans-serif;font-size: 14px;font-style: normal;font-stretch: normal;letter-spacing: -0.6px;">이 이메일은 발신전용 메일입니다.</p>
            <p style="margin-top:0;margin-bottom:0;text-align:center;color:rgba(0,0,0,0.65);font-family:sans-serif;font-size: 14px;font-style: normal;font-stretch: normal;letter-spacing: -0.6px;">문의: seah.ahn.nt@gmail.com</p>
            <div style="line-height:10px;font-size:1px">&nbsp;</div>
            <div style="line-height:10px;font-size:1px">&nbsp;</div>
          </div>

        </div>
      </div>

    </div>
  </div>

  <!-- 푸터 -->
  <div>
    <div style="margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px);word-wrap:break-word;word-break:break-word">
      <div style="border-collapse:collapse;display:table;width:100%">
        <div style="text-align:left;font-size:12px;line-height:19px;color:#b8b8b8;font-family:sans-serif;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)">
          <div style="margin-left:20px;margin-right:20px;margin-top:20px;margin-bottom:20px">

            <div style="font-size:12px;line-height:20px">
              <strong style="color:rgba(0,0,0,0.85);font-family:sans-serif;font-size: 14px;font-style: normal;font-stretch: normal;letter-spacing: -0.6px;">Team MASK</strong>
              <p style="color:rgba(0,0,0,0.7);font-family:sans-serif;font-size: 12px;letter-spacing:-0.5px;font-style: normal;font-stretch: normal;font-weight:normal;margin-top:0">서울특별시 동작구</p>
              <p style="color:rgba(0,0,0,0.5);font-family:sans-serif;font-size: 11px;letter-spacing:normal;font-style: normal;font-stretch: normal;font-weight:normal;">COPYRIGHT TeamMASK ALL RIGHTS RESERVED</p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div style="line-height:40px;font-size:40px">&nbsp;</div>

</td></tr></tbody></table>
  ';    // 메일 내용

  // Gmail로 메일을 발송하기 위해서는 CA인증이 필요하다.
    // CA 인증을 받지 못한 경우에는 아래 설정하여 인증체크를 해지하여야 한다.
    $mail -> SMTPOptions = array(
      "ssl" => array(
            "verify_peer" => false
          , "verify_peer_name" => false
          , "allow_self_signed" => true
      )
  );

  // 메일 전송
  $mail -> send();

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error : ", $mail -> ErrorInfo;
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
		<link rel="stylesheet" href="../assets/css/pwsent_chunk.css" />
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
                    <div data-v-0b9a799b="" class="card">
                        <div data-v-0b9a799b="" class="content">
                            <h1 data-v-0b9a799b="">TENTUPLAY</h1>
                            <h2 data-v-0b9a799b="">메일함을 확인해주세요</h2>
                            <p data-v-0b9a799b="">입력하신 이메일로 비밀번호 재설정 안내 메일이 전송되었습니다.<br>문제가 발생하였을 경우, <a href="mailto:seah.ahn.nt@gmail.com">고객센터</a>로 문의해주세요.</p>
                            <div data-v-0b9a799b="" class="center aligned" style="margin-top: 2rem;"><a data-v-0b9a799b="" href="login.php" class="fluid primary button"> 로그인 페이지로 돌아가기 </a></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>