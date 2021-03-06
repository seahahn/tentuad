// 화면 하단 광고 지표(노출 수, 클릭 수, 클릭률 등) 표시하는 테이블
// 언어 설정 한국어로 변경
var lang_kor = {
    "decimal" : "",
    "emptyTable" : "데이터가 없습니다.",
    "info" : "_START_ - _END_ (총 _TOTAL_ 개)",
    "infoEmpty" : "0개",
    "infoFiltered" : "(전체 _MAX_ 개 중 검색결과)",
    "infoPostFix" : "",
    "thousands" : ",",
    "lengthMenu" : "_MENU_ 개씩 보기",
    "loadingRecords" : "로딩중...",
    "processing" : "처리중...",
    "search" : "검색 : ",
    "zeroRecords" : "검색된 데이터가 없습니다.",
    "paginate" : {
        "first" : "첫 페이지",
        "last" : "마지막 페이지",
        "next" : "다음",
        "previous" : "이전"
    },
    "aria" : {
        "sortAscending" : " :  오름차순 정렬",
        "sortDescending" : " :  내림차순 정렬"
    }
};
$(document).ready( function () {
    $('#table_ad').DataTable({ // 광고 지표(광고별) 테이블 초기화
        language : lang_kor,
        "autoWidth": false,
        columnDefs: [
            {
                targets: "_all",
                className: 'dt-head-center dt-body-center'
            }
        ]
    });

    $('#table_ps').DataTable({ // 광고 지표(페르소나별) 테이블 초기화
        language : lang_kor,
        columnDefs: [
            {
                targets: "_all",
                className: 'dt-head-center dt-body-center'
            }
        ]
    });
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
$('#datepicker_e').datepicker("option", "minDate", $("#datepicker_s").val()); // 시작일 이전 선택 불가
$('#datepicker_e').datepicker("option", "maxDate", 0); // 오늘 날짜 이후로 선택 불가
$('#datepicker_e').datepicker("option", "onClose", function ( selectedDate ) {
    $("#datepicker_s").datepicker( "option", "maxDate", selectedDate );
});

// 화면 열때 종료일은 오늘, 시작일은 오늘로부터 7일 전으로 초기화
$('#datepicker_s').datepicker('setDate', '-7D'); //(-1D:하루전, -1M:한달전, -1Y:일년전), (+1D:하루후, -1M:한달후, -1Y:일년후)
$('#datepicker_e').datepicker('setDate', 'today'); //(-1D:하루전, -1M:한달전, -1Y:일년전), (+1D:하루후, -1M:한달후, -1Y:일년후)

// 시작일, 종료일과 이에 따른 노출 수, 클릭 수 데이터를 불러오기 위한 변수 초기화
var sdate = $( "#datepicker_s" ).datepicker( "getDate" ); // 차트 시작일
var edate = $( "#datepicker_e" ).datepicker( "getDate" ); // 차트 종료일
var imp = []; // 노출 수
var click = []; // 클릭 수

// 화면 중앙 광고 지표 표시하는 꺾은선그래프(차트)
var ctx = document.getElementById('myChart').getContext('2d'); // 차트 불러올 위치 초기화
// 차트 옵션 초기화
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
            }],
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    precision: 0
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
};
var chart = new Chart(ctx, config); // 차트 초기화

// 페이지 로드 시 시작일~종료일에 해당되는 노출수, 클릭수 불러오기
$(document).ready( function () {
    if(getParam("adidx") == "") { // 전체 광고 대시보드인 경우
        $.ajax({
            url : "./impclick.php",
            type : "POST",
            // traditional : true,
            dataType : "JSON",        
            data : {
                // "adidx" : getParam("adidx"),
                "labels" : chart.data.labels // 시작일~종료일 날짜들 담은 배열 보내기
            },
            success : function(data){
                if(data){
                    imp = data.imp;
                    click = data.click;
                    imp_sum = data.imp_sum;
                    click_sum = data.click_sum;
                    $('#imp_sum').text(imp_sum);
                    $('#click_sum').text(click_sum);
                    $('#cost_sum').text(click_sum*100);
                    chart.data.datasets = [
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

        // 광고 지표(광고별) 테이블의 노출 수, 클릭 수 데이터 불러오기
        $.ajax({
            url : "./impclick_ad.php",
            type : "POST",
            // traditional : true,
            dataType : "HTML",
            data : {
                // "adidx" : adid,
                "labels" : chart.data.labels // 시작일~종료일 날짜들 담은 배열 보내기
            },
            success : function(data){
                if(data){
                    $("#adTable_body").html(data);
                } else {
                    console.log("노출수, 클릭수 불러오기 실패");
                }
            }
        });

        // 광고 지표(페르소나별) 테이블의 노출 수, 클릭 수 데이터 불러오기
        $.ajax({
            url : "./impclick_ps.php",
            type : "POST",
            // traditional : true,
            dataType : "HTML",
            data : {
                // "adidx" : adid,
                "labels" : chart.data.labels // 시작일~종료일 날짜들 담은 배열 보내기
            },
            success : function(data){
                if(data){
                    $("#psTable_body").html(data);
                } else {
                    console.log("노출수, 클릭수 불러오기 실패");
                }
            }
        });
    } else { // 개별 광고 대시보드인 경우
        var adid = getParam("adidx");
        $.ajax({
            url : "./impclick.php",
            type : "POST",
            // traditional : true,
            dataType : "JSON",        
            data : {
                "adidx" : adid,
                "labels" : chart.data.labels // 시작일~종료일 날짜들 담은 배열 보내기
            },
            success : function(data){
                if(data){
                    imp = data.imp;
                    click = data.click;
                    imp_sum = data.imp_sum;
                    click_sum = data.click_sum;
                    $('#imp_sum').text(imp_sum);
                    $('#click_sum').text(click_sum);
                    $('#cost_sum').text(click_sum*100);
                    chart.data.datasets = [
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

        // 광고 지표(페르소나별) 테이블의 노출 수, 클릭 수 데이터 불러오기
        $.ajax({
            url : "./impclick_ps.php",
            type : "POST",
            // traditional : true,
            dataType : "HTML",
            data : {
                "adidx" : adid,
                "labels" : chart.data.labels // 시작일~종료일 날짜들 담은 배열 보내기
            },
            success : function(data){
                if(data){
                    $("#psTable_body").html(data);
                } else {
                    console.log("노출수, 클릭수 불러오기 실패");
                }
            }
        });
    }
});

// 차트 시작일과 종료일 변경 시 이벤트(날짜값 변경, 차트 새로고침)
$("#datepicker_s")
    .datepicker()
    .on("change", function() {
        sdate = $( "#datepicker_s" ).datepicker( "getDate" );
        datepick_s(chart);
});
$("#datepicker_e")
    .datepicker()
    .on("change", function() {
        edate = $( "#datepicker_e" ).datepicker( "getDate" );
        datepick_e(chart);
});

// 시작일 or 종료일 변경 시 차트 새로고침
function datepick_s(chart) {
    chart.options.scales = {
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
            }],
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    precision: 0
                }
            }]
    }

    // X축에 변경된 날짜 범위 적용
    var time = chart.options.scales.xAxes[0].time, // 'time' object reference
        // difference (in days) between min and max date
        timeDiff = moment(time.max).diff(moment(time.min), 'd');
    // populate 'labels' array
    // (create a date string for each date between min and max, inclusive)
    // for (i = 0; i <= timeDiff; i++) {
    //     chart.data.labels.splice(-1,1); // 기존 데이터 전부 제거(안그러면 왼쪽 끝부터 표시되지 않음)
    // }
    chart.data.labels = []; // 기존 데이터 전부 제거(안그러면 왼쪽 끝부터 표시되지 않음)
    
    for (i = 0; i <= timeDiff; i++) { // 새로운 기간 데이터 채우기
        var _label = moment(time.min).add(i, 'd').format('YYYY-MM-DD');
        chart.data.labels.push(_label);
    }
    
    // 새로운 데이터셋 불러오기
    var dataset = chart.data.datasets;
    for(var i=0; i<dataset.length; i++){
        chart.data.datasets.splice(-1,1); // 기존 데이터셋 삭제
    }
    // 변경된 날짜 범위에 해당하는 데이터 가져오기
    checkImpClick();
    setTableImpClick();
}
function datepick_e(chart) {
    chart.options.scales = {
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
            }],
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    precision: 0
                }
            }]
    }

    // X축에 변경된 날짜 범위 적용
    var time = chart.options.scales.xAxes[0].time, // 'time' object reference
        // difference (in days) between min and max date
        timeDiff = moment(time.max).diff(moment(time.min), 'd');
    // populate 'labels' array
    // (create a date string for each date between min and max, inclusive)
    // for (i = 0; i <= timeDiff; i++) {
    //     chart.data.labels.splice(-1,1); // 기존 데이터 전부 제거(안그러면 왼쪽 끝부터 표시되지 않음)
    // }
    chart.data.labels = []; // 기존 데이터 전부 제거(안그러면 왼쪽 끝부터 표시되지 않음)

    for (i = 0; i <= timeDiff; i++) { // 새로운 기간 데이터 채우기
        var _label = moment(time.min).add(i, 'd').format('YYYY-MM-DD');
        chart.data.labels.push(_label);
    }

    // 새로운 데이터셋 불러오기
    var dataset = chart.data.datasets;
    for(var i=0; i<dataset.length; i++){
        chart.data.datasets.splice(-1,1); // 기존 데이터셋 삭제
    }
    // 변경된 날짜 범위에 해당하는 데이터 가져오기
    checkImpClick();
    setTableImpClick();
}

/* 상단 요약과 그래프에 시작일~종료일에 해당되는 노출수, 클릭수 불러오기*/
function checkImpClick(){
    if(getParam("adidx") == "") { // 전체 광고 대시보드인 경우
        $.ajax({
            url : "./impclick.php",
            type : "POST",
            // traditional : true,
            dataType : "JSON",        
            data : {
                // "adidx" : getParam("adidx"),
                "labels" : chart.data.labels // 시작일~종료일 날짜들 담은 배열 보내기
            },
            success : function(data){
                if(data){
                    imp = data.imp;
                    click = data.click;
                    imp_sum = data.imp_sum;
                    click_sum = data.click_sum;
                    $('#imp_sum').text(imp_sum);
                    $('#click_sum').text(click_sum);
                    $('#cost_sum').text(click_sum*100);
                    chart.data.datasets = [
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
    } else { // 개별 광고 대시보드인 경우
        var adid = getParam("adidx");
        $.ajax({
            url : "./impclick.php",
            type : "POST",
            // traditional : true,
            dataType : "JSON",        
            data : {
                "adidx" : adid,
                "labels" : config.data.labels // 시작일~종료일 날짜들 담은 배열 보내기
            },
            success : function(data){
                if(data){
                    imp = data.imp;
                    click = data.click;
                    imp_sum = data.imp_sum;
                    click_sum = data.click_sum;
                    $('#imp_sum').text(imp_sum);
                    $('#click_sum').text(click_sum);
                    $('#cost_sum').text(click_sum*100);
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
                    console.log(data.noset);
                } else {
                    console.log("노출수, 클릭수 불러오기 실패");
                }
            }
        });
    }
}
// 광고 지표 테이블 데이터 불러오기
function setTableImpClick() {
    if(getParam("adidx") == "") { // 전체 광고 대시보드인 경우
        $.ajax({ // 광고 지표(광고별) 테이블 데이터 불러오기
            url : "./impclick_ad.php",
            type : "POST",
            // traditional : true,
            dataType : "HTML",
            data : {
                // "adidx" : adid,
                "labels" : chart.data.labels // 시작일~종료일 날짜들 담은 배열 보내기
            },
            success : function(data){
                if(data){
                    $("#adTable_body").html(data);
                } else {
                    console.log("노출수, 클릭수 불러오기 실패");
                }
            }
        });
    
        $.ajax({ // 광고 지표(페르소나별) 테이블 데이터 불러오기
            url : "./impclick_ps.php",
            type : "POST",
            // traditional : true,
            dataType : "HTML",
            data : {
                // "adidx" : adid,
                "labels" : chart.data.labels // 시작일~종료일 날짜들 담은 배열 보내기
            },
            success : function(data){
                if(data){
                    $("#psTable_body").html(data);
                } else {
                    console.log("노출수, 클릭수 불러오기 실패");
                }
            }
        });
    } else { // 개별 광고 대시보드인 경우
        var adid = getParam("adidx");
        $.ajax({ // 광고 지표(페르소나별) 테이블 데이터 불러오기
            url : "./impclick_ps.php",
            type : "POST",
            // traditional : true,
            dataType : "HTML",
            data : {
                "adidx" : adid,
                "labels" : chart.data.labels // 시작일~종료일 날짜들 담은 배열 보내기
            },
            success : function(data){
                if(data){
                    $("#psTable_body").html(data);
                } else {
                    console.log("노출수, 클릭수 불러오기 실패");
                }
            }
        });
    }
    
}

// url 에서 parameter 추출(GET값 가져오기)
function getParam(sname) {
    var params = location.search.substr(location.search.indexOf("?") + 1);
    var sval = "";
    params = params.split("&");
    for (var i = 0; i < params.length; i++) {
        temp = params[i].split("=");
        if ([temp[0]] == sname) { sval = temp[1]; }
    }
    return sval;
}