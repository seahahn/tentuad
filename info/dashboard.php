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
                                            <div class="d-flex justify-content-between">
                                            <span class="align-self-center">그래프</span>
                                            <span class="align-self-center">기간 : <input type="text" id="datepicker_s" onselect="datepick();"> ~ <input type="text" id="datepicker_e" onselect="datepick();"></span>
                                            </div>
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
                                                <tbody>
                                                        <?php
                                                        $sql = mq("SELECT * FROM adList WHERE owner_idx = '$idx' ORDER BY title DESC, period_s ASC");
                                                        while($ad = $sql->fetch_array()){
                                                            $idx = $ad['idx'];
                                                            $title = $ad['title'];
                                                            $onoff = $ad['onoff'];
                                                            $status = $ad['status'];
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
                                                        <td><input class="form-check-input" type="checkbox" value="check_<?=$idx?>" id="check_<?=$idx?>"></td>
                                                        <td><?=$title;?></td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="switch_<?=$idx?>" checked>
                                                            </div>
                                                        </td>
                                                        <td><?=$status_show;?></td>
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
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript">
        console.log(moment().format("MM-DD"));

        // 화면 하단 광고 지표(노출 수, 클릭 수, 클릭률 등) 표시하는 테이블
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );

        // 화면 중앙 차트에서 기간 설정하는 부분(시작일 ~ 종료일)
        // 옵션 한국어 세팅
        $.datepicker.regional['ko'] = {
            closeText: '닫기',
            prevText: '이전달',
            nextText: '다음달',
            currentText: '오늘',
            monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
            '7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
            monthNamesShort: ['1월','2월','3월','4월','5월','6월',
            '7월','8월','9월','10월','11월','12월'],
            dayNames: ['일','월','화','수','목','금','토'],
            dayNamesShort: ['일','월','화','수','목','금','토'],
            dayNamesMin: ['일','월','화','수','목','금','토'],
            weekHeader: 'Wk',
            dateFormat: 'yy-mm-dd',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: true,
            yearSuffix: '',
            showOn: 'focus',
            buttonText: "달력",
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: 'c-99:c+99',
        };
        $.datepicker.setDefaults($.datepicker.regional['ko']);

        // 시작일이 종료일보다 뒤에 있는 경우 방지
        $('#datepicker_s').datepicker(); // 시작일 초기화
        $('#datepicker_s').datepicker("option", "maxDate", $("#datepicker_e").val()); // 종료일 넘겨서 선택 불가
        $('#datepicker_s').datepicker("option", "onClose", function ( selectedDate ) {
            $("#datepicker_e").datepicker( "option", "minDate", selectedDate );
        });
        $('#datepicker_e').datepicker(); // 종료일 초기화
        $('#datepicker_e').datepicker("option", "minDate", $("#datepicker_s").val()); // 시작일 넘겨서 선택 불가
        $('#datepicker_e').datepicker("option", "maxDate", 0); // 오늘 날짜 이후로 선택 불가
        $('#datepicker_e').datepicker("option", "onClose", function ( selectedDate ) {
            $("#datepicker_s").datepicker( "option", "maxDate", selectedDate );
        });

        // 화면 열때 종료일은 오늘, 시작일은 오늘로부터 7일 전으로 초기화
        $('#datepicker_s').datepicker('setDate', '-7D'); //(-1D:하루전, -1M:한달전, -1Y:일년전), (+1D:하루후, -1M:한달후, -1Y:일년후)
        $('#datepicker_e').datepicker('setDate', 'today'); //(-1D:하루전, -1M:한달전, -1Y:일년전), (+1D:하루후, -1M:한달후, -1Y:일년후)

        var sdate = $( "#datepicker_s" ).datepicker( "getDate" ); // 차트 시작일
        var edate = $( "#datepicker_e" ).datepicker( "getDate" ); // 차트 종료일
        var imp = []; // 노출 수
        var click = []; // 클릭 수

        // 화면 중앙 광고 지표 표시하는 꺾은선그래프(차트)
        var ctx = document.getElementById('myChart').getContext('2d'); // 차트 불러올 위치 초기화
        var config = {
            type: 'line',
            options: {
                scales: {
                    xAxes: [{
                        type: 'time',
                        time: {
                            parser: 'YYYY-MM-DD HH:mm:ss',
                            unit: 'month',
                            displayFormats: {
                                month: 'MM-DD'
                            },
                            min: sdate,
                            max: edate
                        },
                        ticks: {
                            source: 'data'
                        }
                    }]
                }
            },
            plugins: [{
                beforeInit: function(chart) {
                    var time = chart.options.scales.xAxes[0].time, // 'time' object reference
                        // difference (in days) between min and max date
                        timeDiff = moment(time.max).diff(moment(time.min), 'd');
                    // populate 'labels' array
                    // (create a date string for each date between min and max, inclusive)
                    for (i = 0; i <= timeDiff; i++) {
                        var _label = moment(time.min).add(i, 'd').format('YYYY-MM-DD');
                        chart.data.labels.push(_label);
                    }
                }
            }],

            // 차트 안에 들어갈 데이터 내용
            // datasets : 해당 꺾은선그래프의 제목(labels), 그래프 영역 아래 배경색, 그래프 선의 색, 표시할 데이터
            data: {
                datasets: [
                {
                    label: '노출 수',
                    // yAxisID: 'A',
                    backgroundColor: 'rgb(255, 255, 255, 0)',
                    borderColor: 'rgb(255, 105, 0)',
                    data: []
                },
                {
                    label: '클릭 수',
                    // yAxisID: 'A',
                    backgroundColor: 'rgb(255, 255, 255, 0)',
                    borderColor: 'rgb(51, 0, 255)',
                    data: []
                }]
            }
        }; // 차트 옵션 설정
        
        
        var chart = new Chart(ctx, config); // 차트 초기화
        console.log(config.data.labels);
        /* 시작일~종료일에 해당되는 노출수, 클릭수 불러오기*/
        // function checkImpClick(){
            $(document).ready( function () {
                console.log('ajaxtest');
            $.ajax({
                url : "./impclick.php",
                type : "POST",
                // traditional : true,
                dataType : "JSON",
                data : {
                    "labels" : config.data.labels
                },
                success : function(data){
                    if(data){
                        imp = data['imp'];
                        click = data.click;
                        console.log("노출수, 클릭수 불러오기 성공");
                        console.log("data : " + data);
                        console.log(imp);
                        console.log(click);
                        config.data.datasets = [
                        {
                            label: '노출 수',
                            // yAxisID: 'A',
                            backgroundColor: 'rgb(255, 255, 255, 0)',
                            borderColor: 'rgb(255, 105, 0)',
                            data: imp
                        },
                        {
                            label: '클릭 수',
                            // yAxisID: 'A',
                            backgroundColor: 'rgb(255, 255, 255, 0)',
                            borderColor: 'rgb(51, 0, 255)',
                            data: click
                        }];
                        chart.update();
                    } else {
                        console.log("노출수, 클릭수 불러오기 실패");
                    }
                }
            });
        });

        // 차트 시작일과 종료일 변경 시 이벤트(날짜값 변경, 차트 새로고침)
        $("#datepicker_s")
            .datepicker()
            .on("change", function() {
                console.log("Got change event from field");
                sdate = $( "#datepicker_s" ).datepicker( "getDate" );
                console.log(moment(sdate).format("MM-DD"));
                datepick_s(chart);
        });
        $("#datepicker_e")
            .datepicker()
            .on("change", function() {
                console.log("Got change event from field");
                edate = $( "#datepicker_e" ).datepicker( "getDate" );
                console.log(moment(edate).format("MM-DD"));
                datepick_e(chart);
        });

        // 시작일 or 종료일 변경 시 차트 새로고침
        function datepick_s(chart) {
            config.options.scales = {
                xAxes: [{
                        type: 'time',
                        time: {
                            parser: 'YYYY-MM-DD HH:mm:ss',
                            unit: 'month',
                            displayFormats: {
                                month: 'MM-DD'
                            },
                            min: sdate,
                            max: edate
                        },
                        ticks: {
                            source: 'data'
                        }
                    }]
            }

            var imp = []; // 노출 수
            var click = []; // 클릭 수
            // X축에 변경된 날짜 범위 적용
            var time = chart.options.scales.xAxes[0].time, // 'time' object reference
                // difference (in days) between min and max date
                timeDiff = moment(time.max).diff(moment(time.min), 'd');
            // populate 'labels' array
            // (create a date string for each date between min and max, inclusive)
            for (i = 0; i <= timeDiff; i++) {
                chart.data.labels.splice(-1,1); // 기존 데이터 전부 제거(안그러면 왼쪽 끝부터 표시되지 않음)
            }
            for (i = 0; i <= timeDiff; i++) {
                var _label = moment(time.min).add(i, 'd').format('YYYY-MM-DD HH:mm:ss');
                chart.data.labels.push(_label);
            }

            // 새로운 데이터셋 불러오기
            var dataset = config.data.datasets;
		    for(var i=0; i<dataset.length; i++){
                config.data.datasets.splice(-1,1); // 기존 데이터셋 삭제
            }
            config.data.datasets = [
                {
                    label: '노출 수',
                    // yAxisID: 'A',
                    backgroundColor: 'rgb(255, 255, 255, 0)',
                    borderColor: 'rgb(255, 105, 0)',
                    data: imp
                },
                {
                    label: '클릭 수',
                    // yAxisID: 'A',
                    backgroundColor: 'rgb(255, 255, 255, 0)',
                    borderColor: 'rgb(51, 0, 255)',
                    data: click
                }];

            console.log(config.data.datasets);
            chart.update();
        }

        function datepick_e(chart) {
            config.options.scales = {
                xAxes: [{
                        type: 'time',
                        time: {
                            parser: 'YYYY-MM-DD HH:mm:ss',
                            unit: 'month',
                            displayFormats: {
                                month: 'MM-DD'
                            },
                            min: sdate,
                            max: edate
                        },
                        ticks: {
                            source: 'data'
                        }
                    }]
            }

            var imp = []; // 노출 수
            var click = []; // 클릭 수
            // X축에 변경된 날짜 범위 적용
            var time = chart.options.scales.xAxes[0].time, // 'time' object reference
                // difference (in days) between min and max date
                timeDiff = moment(time.max).diff(moment(time.min), 'd');
            // populate 'labels' array
            // (create a date string for each date between min and max, inclusive)
            for (i = 0; i <= timeDiff; i++) {
                chart.data.labels.splice(-1,1); // 기존 데이터 전부 제거(안그러면 왼쪽 끝부터 표시되지 않음)
            }
            for (i = 0; i <= timeDiff; i++) {
                var _label = moment(time.min).add(i, 'd').format('YYYY-MM-DD HH:mm:ss');
                chart.data.labels.push(_label);
                imp.push((Math.floor(Math.random() * (300 - 100)) + 100));
                click.push(Math.floor(Math.random() * (100 - 0)));
            }
            
            // 새로운 데이터셋 불러오기
            var dataset = config.data.datasets;
		    for(var i=0; i<dataset.length; i++){
                config.data.datasets.splice(-1,1); // 기존 데이터셋 삭제
            }
            config.data.datasets = [
                {
                    label: '노출 수',
                    // yAxisID: 'A',
                    backgroundColor: 'rgb(255, 255, 255, 0)',
                    borderColor: 'rgb(255, 105, 0)',
                    data: imp
                },
                {
                    label: '클릭 수',
                    // yAxisID: 'A',
                    backgroundColor: 'rgb(255, 255, 255, 0)',
                    borderColor: 'rgb(51, 0, 255)',
                    data: click
                }];
            
            console.log("datepick_e");
            chart.update();
        }
        </script>
    </body>
</html>