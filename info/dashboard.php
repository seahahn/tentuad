<?php
include_once "../util/config.php";
include_once "../util/db_con.php";

$aduser = mq("SELECT * FROM aduser WHERE email='$email'");
$userinfo = mysqli_fetch_array($aduser);
$money = $userinfo['money']; // 광고주가 소지한 광고용 충전 금액

// 광고 지표(광고별) 테이블의 데이터 채우기 위한 값들 불러오기
$adlist = mq("SELECT * FROM adList WHERE owner_idx = '$idx'");
$budget_sum = 0; // 광고 예산 합계
$cost_sum = 0; // 광고 비용 합계
$imp_sum = 0; // 광고 노출 수 합계
$click_sum = 0; // 광고 클릭 수 합계
while($count = $adlist->fetch_array()){
    $budget_sum += $count['budget'];
    $cost_sum += $count['cost'];
    $imp_sum += $count['imp'];
    $click_sum += $count['click'];
}

if(isset($_GET['adidx'])) {
    $adidx = $_GET['adidx'];
    $sql = mq("SELECT * FROM adList WHERE idx='".$adidx."'");
    $result = mysqli_fetch_array($sql);
    $dashboard_title = ' - '.$result['title'];
} else {
    $dashboard_title = "";
}
?>
<!DOCTYPE HTML>
<html>	
    <head>
		<title>TentuAd: AI 광고 어시스턴트</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
        <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
        <link rel="stylesheet" href="../assets/css/jquery-ui.css" />
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
                            <div class="d-flex justify-content-between">
                                <h2 class="page headline"><span class="align-self-center">대시보드 <?=$dashboard_title?></span></h2>
                                <div>
                                    <i class="small calendar icon"><svg style="fill: #ff6900"><use xlink:href="../assets/css/images/sprites.df5ba72e.svg#calendar"></use></svg></i>
                                    <span class="align-self-center">기간 : <input type="text" id="datepicker_s"> ~ <input type="text" id="datepicker_e"></span>
                                </div>
                            </div>

                            <!-- 상단 요약 시작 -->
                            <!-- 전체 광고에 대한 데이터 보여주는 경우 -->
                            <?php if(!isset($_GET['adidx'])) { ?>
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
                                            <dd class="sub"></dd>
                                            <dd role="status"><!----></dd>
                                            <dd class="highlight"><?=$money?> 원</dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">전체 예산</dt>
                                            <dd role="status"><!----></dd>
                                            <dd class="highlight"><?=$budget_sum?> 원</dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">전체 비용</dt>
                                            <dd role="status"><!----></dd>
                                            <dd class="highlight"><span id="cost_sum"></span> 원</dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">전체 노출 수</dt>
                                            <dd role="status"><!----></dd>
                                            <dd class="highlight"><span id="imp_sum"></span></dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">전체 클릭 수</dt>
                                            <dd role="status"><!----></dd>
                                            <dd class="highlight"><span id="click_sum"></span></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- 개별 광고에 대한 데이터 보여주는 경우 -->
                            <?php 
                            } else { 
                                $adidx = $_GET['adidx'];
                                $sql = mq("SELECT * FROM adList WHERE idx = '$adidx'");
                                $result = mysqli_fetch_array($sql);
                                $status = $result['status'];
                                switch($status){
                                    //광고중(0), 광고 중지(1), 광고 운영 불가(예산 부족(2), 검수 반려(3)), 심사중(4)
                                    case 0:
                                        $status_show = '광고중';
                                        break;
                                    case 1:
                                        $status_show = '광고 중지';
                                        break;
                                    case 2:
                                        $status_show = '예산 부족';
                                        break;
                                    case 3:
                                        $status_show = '검수 반려';
                                        break;
                                    case 4:
                                        $status_show = '심사중';
                                        break;
                                }
                                $budget = $result['budget'];
                                $cost = $result['cost'];
                                $imp = $result['imp'];
                                $click = $result['click'];
                            ?>
                            <div class="grid with gutter">
                                <div class="twelve wide column">
                                <div class="card">
                                    <h5 class="title">요약</h5>
                                    <div class="content">
                                        <div class="summary grid">
                                            <dl>
                                            <dt class="small headline">
                                                <span class="align-middle me-3">상태</span>
                                            </dt>
                                            <dd class="sub"></dd>
                                            <dd role="status"><!----></dd>
                                            <dd class="highlight"><?=$status_show?></dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">광고 예산</dt>
                                            <dd role="status"><!----></dd>
                                            <dd class="highlight"><?=$budget?> 원</dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">광고 비용</dt>
                                            <dd role="status"><!----></dd>
                                            <dd class="highlight"><span id="cost_sum"></span> 원</dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">노출 수</dt>
                                            <dd role="status"><!----></dd>
                                            <dd class="highlight"><span id="imp_sum"></span></dd>
                                            </dl>

                                            <dl>
                                            <dt class="small headline">클릭 수</dt>
                                            <dd role="status"><!----></dd>
                                            <dd class="highlight"><span id="click_sum"></span></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- 상단 요약 끝 -->



                            <!-- 광고 지표 그래프 표시 시작 -->
                            <div class="grid with gutter">
                                <div class="twelve wide column">
                                <div>
                                    <div data-v-80081fce="" class="card" chart-type="Line">
                                        <h5 data-v-80081fce="" class="title">
                                            <div class="d-flex justify-content-between">
                                            <span class="align-self-center">그래프</span>
                                            <!-- <span class="align-self-center">기간 : <input type="text" id="datepicker_s" onselect="datepick();"> ~ <input type="text" id="datepicker_e" onselect="datepick();"></span> -->
                                            </div>
                                        </h5>
                                        <div data-v-80081fce="" class="content">
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- 광고 지표 그래프 표시 끝 -->



                            <!-- 전체 광고에 대한 데이터 보여주는 경우에만 광고별 광고 지표 테이블을 보여줌 -->
                            <!-- 광고별 예산, 비용, 노출 수, 클릭 수, 클릭률 표시 시작 -->
                            <?php if(!isset($_GET['adidx'])) { ?>                            
                            <div class="grid with gutter">
                                <div class="twelve wide column">
                                <div>
                                    <div data-v-defd96e4="" class="card" chart-type="Bar">
                                        <h5 data-v-defd96e4="" class="title">
                                            광고 지표(광고별)
                                            <!-- <i data-v-defd96e4="" class="help icon has-tooltip" data-original-title="null">
                                                <svg data-v-defd96e4="">
                                                    <use data-v-defd96e4="" xlink:href="../assets/css/images/sprites.df5ba72e.svg#help-circle"></use>
                                                </svg>
                                            </i> -->
                                        </h5>
                                        <div class="px-1 py-3">
                                            <table id="table_ad" class="display">
                                                <thead>
                                                    <tr>
                                                        <th class="tablecheck" style="background-image: url()"><input class="form-check-input" type="checkbox" value="" id="check_all"></th>
                                                        <th>광고 제목</th>
                                                        <th>ON/OFF</th>
                                                        <th>상태</th>
                                                        <th>예산</th>
                                                        <th>비용</th>
                                                        <th>노출 수</th>
                                                        <th>클릭 수</th>
                                                        <th>클릭률</th>
                                                        <th>노출당 비용</th>
                                                        <th>클릭당 비용</th>
                                                        <th>기간</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="adTable_body">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- 광고별 예산, 비용, 노출 수, 클릭 수, 클릭률 표시 끝 -->



                            <!-- 페르소나별 비용, 노출 수, 클릭 수, 클릭률 표시 시작 -->
                            <!-- 전체 광고에 대한 데이터 보여주는 경우 -->
                            <?php if(!isset($_GET['adidx'])) { ?>
                            <div class="grid with gutter">
                                <div class="twelve wide column">
                                <div>
                                    <div data-v-defd96e4="" class="card" chart-type="Bar">
                                        <h5 data-v-defd96e4="" class="title">
                                            광고 지표(페르소나별)
                                            <!-- <i data-v-defd96e4="" class="help icon has-tooltip" data-original-title="null">
                                                <svg data-v-defd96e4="">
                                                    <use data-v-defd96e4="" xlink:href="../assets/css/images/sprites.df5ba72e.svg#help-circle"></use>
                                                </svg>
                                            </i> -->
                                        </h5>
                                        <div class="px-1 py-3">
                                            <table id="table_ps" class="display">
                                                <thead>
                                                    <tr>
                                                        <th>페르소나명</th>
                                                        <th>비용</th>
                                                        <th>노출 수</th>
                                                        <th>클릭 수</th>
                                                        <th>클릭률</th>
                                                        <th>노출당 비용</th>
                                                        <th>클릭당 비용</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="psTable_body">
                                                        <?php
                                                        // for($i=0; $i<count($ps); $i++){
                                                        //     $title = $ps[$i];
                                                        //     $imp_show = (int)$imp_ps[$i];
                                                        //     $click_show = (int)$click_ps[$i];
                                                        //     $cost = $click_show * 100;
                                                        ?>
                                                    <!-- <tr>
                                                        <td><?=$title;?></td>
                                                        <td><?=$cost;?></td>
                                                        <td><?=$imp_show;?></td>
                                                        <td><?=$click_show;?></td>
                                                        <td><?php if($imp_show==0) { echo '-';} else { echo round(($click_show/$imp_show)*100).'%';}?></td>
                                                        <td><?php if($imp_show==0) { echo '-';} else { echo round($cost/$imp_show);}?></td>
                                                        <td><?php if($click_show==0) { echo '-';} else { echo round($cost/$click_show);}?></td>
                                                    </tr> -->
                                                        <?php
                                                        // }
                                                        ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- 개별 광고에 대한 데이터 보여주는 경우 -->
                            <?php 
                            } else { 
                            ?>
                            <div class="grid with gutter">
                                <div class="twelve wide column">
                                <div>
                                    <div data-v-defd96e4="" class="card" chart-type="Bar">
                                        <h5 data-v-defd96e4="" class="title">
                                            광고 지표(페르소나별)
                                            <!-- <i data-v-defd96e4="" class="help icon has-tooltip" data-original-title="null">
                                                <svg data-v-defd96e4="">
                                                    <use data-v-defd96e4="" xlink:href="../assets/css/images/sprites.df5ba72e.svg#help-circle"></use>
                                                </svg>
                                            </i> -->
                                        </h5>
                                        <div class="px-1 py-3">
                                            <table id="table_ps" class="display">
                                                <thead>
                                                    <tr>
                                                        <th>페르소나명</th>
                                                        <th>비용</th>
                                                        <th>노출 수</th>
                                                        <th>클릭 수</th>
                                                        <th>클릭률</th>
                                                        <th>노출당 비용</th>
                                                        <th>클릭당 비용</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="psTable_body">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- 페르소나별 비용, 노출 수, 클릭 수, 클릭률 표시 끝 -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once "../util/scripts.php" ?>
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="../assets/js/dashboard.js"></script>
    </body>
</html>