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
                    <div id="content" class="d-flex flex-column">
                    <i data-v-42570b20="" class="round icon align-self-end"><svg data-v-42570b20=""><use data-v-42570b20="" xlink:href="/img/sprites.df5ba72e.svg#user"></use></svg></i>
                    <div>
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
                                            <dd class="highlight">100,000 원</dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">
                                                전체 예산
                                            </dt>
                                            <dd role="status">
                                                <!---->
                                            </dd>
                                            <dd class="highlight">50,000 원</dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">
                                                전체 비용
                                            </dt>
                                            <dd role="status">
                                                <!---->
                                            </dd>
                                            <dd class="highlight">30,000 원</dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">
                                                전체 노출 수
                                            </dt>
                                            <dd role="status">
                                                <!---->
                                            </dd>
                                            <dd class="highlight">100</dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">
                                                전체 클릭 수
                                            </dt>
                                            <dd role="status">
                                                <!---->
                                            </dd>
                                            <dd class="highlight">70</dd>
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
    </body>
</html>