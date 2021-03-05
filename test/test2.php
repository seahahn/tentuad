<?php
include_once "../util/config.php";
include_once "../util/db_con.php";

$aduser = mq("SELECT * FROM aduser WHERE email='$email'");
$userinfo = mysqli_fetch_array($aduser);
$money = $userinfo['money']; // 광고주가 소지한 광고용 충전 금액

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

?>

<!DOCTYPE HTML>
<html>	
    <head>
		<title>TentuAd: AI 광고 어시스턴트</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
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
                            <h2 class="page headline">대시보드</h2>

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

                            <!-- 대시보드 메인 시작 -->
                            <!-- 광고 지표 그래프 표시 시작 -->
                            <div class="grid with gutter">
                                <div class="twelve wide column">
                                <div>
                                    <div data-v-80081fce="" class="card" chart-type="Line">
                                        <h5 data-v-80081fce="" class="title">
                                            그래프
                                            <i data-v-80081fce="" class="help icon has-tooltip" data-original-title="null">
                                            <svg data-v-80081fce="">
                                                <use data-v-80081fce="" xlink:href="/img/sprites.df5ba72e.svg#help-circle"></use>
                                            </svg>
                                            </i>
                                        </h5>
                                        <div data-v-80081fce="" class="content">
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- 사용자 정보, 광고 지표 그래프 표시 끝 -->
                            <!-- 광고별 예산, 비용, 노출 수, 클릭 수, 클릭률 표시 시작 -->
                            <div class="grid with gutter">
                                <div class="twelve wide column">
                                <div>
                                    <div data-v-defd96e4="" class="card" chart-type="Bar">
                                        <h5 data-v-defd96e4="" class="title">
                                            광고 지표
                                            <i data-v-defd96e4="" class="help icon has-tooltip" data-original-title="null">
                                            <svg data-v-defd96e4="">
                                                <use data-v-defd96e4="" xlink:href="/img/sprites.df5ba72e.svg#help-circle"></use>
                                            </svg>
                                            </i>
                                        </h5>
                                        <div class="px-1 py-3">
                                            <table id="table_id" class="display">
                                                <thead>
                                                    <tr>
                                                        <th><input class="form-check-input" type="checkbox" value="" id="check_all"></th>
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
                                                <tbody>
                                                        <?php
                                                        $sql = mq("SELECT * FROM adList WHERE owner_idx = '$idx' ORDER BY title DESC, period_s ASC");
                                                        while($ad = $sql->fetch_array()){
                                                            $title = $ad['title'];
                                                            $onoff = $ad['onoff'];
                                                            $status = $ad['status'];
                                                            $budget = $ad['budget'];
                                                            $cost = $ad['cost'];
                                                            $imp = $ad['imp'];
                                                            $click = $ad['click'];

                                                            $start = $ad['period_s'];
                                                            $timestamp = strtotime($start);
                                                            $start = date("Y-m-d", $timestamp);
                                                            $end = $ad['period_e'];
                                                            $end = $ad['period_e'];
                                                            $timestamp = strtotime($end);
                                                            $end = date("Y-m-d", $timestamp);
                                                            $end_year = date("Y", $timestamp);
                                                            if($end_year == 9999) $end = "종료일 없음";
                                                        ?>
                                                    <tr>
                                                        <td>ㅁ</td>
                                                        <td><?=$title;?></td>
                                                        <td>(스위치)</td>
                                                        <td><?=$status;?></td>
                                                        <td><?=$budget;?></td>
                                                        <td><?=$cost;?></td>
                                                        <td><?=$imp;?></td>
                                                        <td><?=$click;?></td>
                                                        <td><?php if($imp==0) { echo '-';} else { ($click/$imp)*100; }?></td>
                                                        <td><?php if($imp==0) { echo '-';} else { $cost/$imp; }?></td>
                                                        <td><?php if($click==0) { echo '-';} else { $cost/$click; }?></td>
                                                        <td><?=$start.' ~ '.$end;?></td>
                                                    </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- 광고별 예산, 비용, 노출 수, 클릭 수, 클릭률 표시 끝 -->
                            <!-- 대시보드 메인 끝 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once "../util/scripts.php" ?>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );

        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgb(255, 255, 255, 0)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20, 30, 45]
                },
                {
                    label: 'My Second dataset',
                    backgroundColor: 'rgb(255, 255, 255, 0)',
                    borderColor: 'rgb(51, 0, 255)',
                    data: [3, 14, 6, 7, 4, 25, 45]
                }]
            },

            // Configuration options go here
            options: {}
        });
        </script>
    </body>
</html>