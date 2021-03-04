<?php
include_once "../util/config.php";
include_once "../util/db_con.php";

$aduser = mq("SELECT * FROM aduser WHERE email='$email'");
$userinfo = mysqli_fetch_array($aduser);
$money = $userinfo['money'];

$adlist = mq("SELECT * FROM adList WHERE owner_idx = '$idx'");
$adinfo = mysqli_fetch_array($adlist);
$budget_sum; // 광고 예산 합계
$cost_sum; // 광고 비용 합계
$imp_sum; // 광고 노출 수 합계
$click_sum; // 광고 클릭 수 합계
while($count = $adlist->fetch_array()){
    $budget_sum += $count['budget'];
    $cost_sum += $count['cost'];
    $imp_sum += $count['imp'];
    $click_sum += $count['click'];
}

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
                <?php include_once "../fragment/sidebar.php"; ?>

                <div id="main">
                    <?php include_once "../fragment/profile_icon.php";?>

                        <div class="container">
                            <h2 class="page headline">대시보드</h2>
                            <div class="right aligned">
                                <div data-v-f6def87c="" class="datepicker">
                                <i data-v-f6def87c="" class="small calendar icon">
                                    <svg data-v-f6def87c="">
                                        <use data-v-f6def87c="" xlink:href="/img/sprites.df5ba72e.svg#calendar"></use>
                                    </svg>
                                </i>
                                <div data-v-f6def87c="" class="label">지난 7일</div>
                                <div data-v-f6def87c="" class="binding">2021년 2월 23일 - 3월 1일</div>
                                <i data-v-f6def87c="" class="small chevron icon">
                                    <svg data-v-f6def87c="">
                                        <use data-v-f6def87c="" xlink:href="/img/sprites.df5ba72e.svg#chevron-down"></use>
                                    </svg>
                                </i>
                                <div data-v-f6def87c="" class="combo">
                                    <ul data-v-f6def87c="">
                                        <li data-v-f6def87c="" class=""> 어제 </li>
                                        <li data-v-f6def87c="" class="active"> 지난 7일 </li>
                                        <li data-v-f6def87c="" class=""> 지난 14일 </li>
                                        <!---->
                                    </ul>
                                </div>
                                </div>
                            </div>

                            <!-- 상단 요약 시작 -->
                            <div class="grid with gutter">
                                <div class="twelve wide column">
                                <div class="card">
                                    <h5 class="title">요약</h5>
                                    <div class="content">
                                        <div class="summary grid">
                                            <dl>
                                            <dt class="small headline">
                                                <span class="align-middle me-3">계정 잔액</span><button type="button" class="btn btn-sm btn-outline-warning py-0">충전하기</button>
                                            </dt>
                                            <dd class="sub">
                                                
                                            </dd>
                                            <dd role="status">
                                                <!---->
                                            </dd>
                                            <dd class="highlight"><?=$money?> 원</dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">
                                                전체 예산
                                            </dt>
                                            <dd role="status">
                                                <!---->
                                            </dd>
                                            <dd class="highlight"><?=$budget_sum?> 원</dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">
                                                전체 비용
                                            </dt>
                                            <dd role="status">
                                                <!---->
                                            </dd>
                                            <dd class="highlight"><?=$cost_sum?> 원</dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">
                                                전체 노출 수
                                            </dt>
                                            <dd role="status">
                                                <!---->
                                            </dd>
                                            <dd class="highlight"><?=$imp_sum?></dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">
                                                전체 클릭 수
                                            </dt>
                                            <dd role="status">
                                                <!---->
                                            </dd>
                                            <dd class="highlight"><?=$click_sum?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- 상단 요약 끝 -->

                            <div class="grid with gutter">
                                <div class="three wide column">
                                <div>
                                    <div data-v-defd96e4="" class="card" chart-type="Bar">
                                        <h5 data-v-defd96e4="" class="title">
                                            (사용자 관련 정보 표시 예정)
                                            <i data-v-defd96e4="" class="help icon has-tooltip" data-original-title="null">
                                            <svg data-v-defd96e4="">
                                                <use data-v-defd96e4="" xlink:href="/img/sprites.df5ba72e.svg#help-circle"></use>
                                            </svg>
                                            </i>
                                        </h5>
                                        <div data-v-defd96e4="" class="content">
                                            <div data-v-defd96e4="" class="spinner">
                                            <!---->
                                            </div>
                                            <div data-v-defd96e4="" class="" style="height: 320px; position: relative;">
                                            <div class="chartjs-size-monitor">
                                                <div class="chartjs-size-monitor-expand">
                                                    <div class=""></div>
                                                </div>
                                                <div class="chartjs-size-monitor-shrink">
                                                    <div class=""></div>
                                                </div>
                                            </div>
                                            <canvas id="bar-chart" width="440" height="320" class="chartjs-render-monitor" style="display: block; width: 440px; height: 320px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="twelve wide column">
                                <div>
                                    <div data-v-80081fce="" class="card" chart-type="Line">
                                        <h5 data-v-80081fce="" class="title">
                                            (그래프 표시 예정)
                                            <i data-v-80081fce="" class="help icon has-tooltip" data-original-title="null">
                                            <svg data-v-80081fce="">
                                                <use data-v-80081fce="" xlink:href="/img/sprites.df5ba72e.svg#help-circle"></use>
                                            </svg>
                                            </i>
                                        </h5>
                                        <div data-v-80081fce="" class="content">
                                            <div data-v-80081fce="" class="spinner">
                                            <!---->
                                            </div>
                                            <div data-v-80081fce="" class="" style="height: 320px; position: relative;">
                                            <div class="chartjs-size-monitor">
                                                <div class="chartjs-size-monitor-expand">
                                                    <div class=""></div>
                                                </div>
                                                <div class="chartjs-size-monitor-shrink">
                                                    <div class=""></div>
                                                </div>
                                            </div>
                                            <canvas id="line-chart" width="440" height="320" class="chartjs-render-monitor" style="display: block; width: 440px; height: 320px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="grid with gutter">
                                <div class="twelve wide column">
                                <div>
                                    <div data-v-defd96e4="" class="card" chart-type="Bar">
                                        <h5 data-v-defd96e4="" class="title">
                                            (노출수, 클릭수, 클릭률 관련 표 표시 예정)
                                            <i data-v-defd96e4="" class="help icon has-tooltip" data-original-title="null">
                                            <svg data-v-defd96e4="">
                                                <use data-v-defd96e4="" xlink:href="/img/sprites.df5ba72e.svg#help-circle"></use>
                                            </svg>
                                            </i>
                                        </h5>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once "../util/scripts.php" ?>
    </body>
</html>