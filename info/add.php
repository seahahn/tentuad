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
        <link rel="stylesheet" href="../assets/css/add.css" />
        <link rel="stylesheet" href="../assets/css/bootstrap.css" />
		<!-- <link rel="stylesheet" href="../assets/css/login_chunk.css" /> -->        
		<link rel="stylesheet" href="../assets/css/dashboard.css" />
	</head>	
    <body style="background-color: #fff;">
        <style type="text/css">a { text-decoration:none } html.hs-messages-widget-open.hs-messages-mobile,html.hs-messages-widget-open.hs-messages-mobile body{overflow:hidden!important;position:relative!important}html.hs-messages-widget-open.hs-messages-mobile body{height:100%!important;margin:0!important}#hubspot-messages-iframe-container{display:initial!important;z-index:2147483647;position:fixed!important;bottom:0!important}#hubspot-messages-iframe-container.widget-align-left{left:0!important}#hubspot-messages-iframe-container.widget-align-right{right:0!important}#hubspot-messages-iframe-container.internal{z-index:1016}#hubspot-messages-iframe-container.internal iframe{min-width:108px}#hubspot-messages-iframe-container .shadow-container{display:initial!important;z-index:-1;position:absolute;width:0;height:0;bottom:0;content:""}#hubspot-messages-iframe-container .shadow-container.internal{display:none!important}#hubspot-messages-iframe-container .shadow-container.active{width:400px;height:400px}#hubspot-messages-iframe-container iframe{display:initial!important;width:100%!important;height:100%!important;border:none!important;position:absolute!important;bottom:0!important;right:0!important;background:transparent!important}</style>
        <noscript>We're sorry, but TENTUPLAY doesn't work properly without JavaScript enabled. Please enable it to continue.</noscript>
        <div>
            <div id="viewport" class="blur1red">
                <?php include_once "../fragment/sidebar.php"; ?>

                <div id="main">
                    <?php include_once "../fragment/profile_icon.php";?>

                        <div class="container">
                            <h2 class="page headline">광고 만들기</h2>
                            
                            <div data-v-defd96e4="" class="card rounded-0 p-5" chart-type="Bar">
                                <form id="formAdd" name="formAdd" enctype="multipart/form-data" method="POST" action="./add_ok.php">
                                    <div class="row mb-3">
                                        <label for="adTitle" class="col col-form-label">광고 제목</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control w-100" id="adTitle" name="adTitle">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="category" class="col col-form-label">광고 카테고리</label>
                                        <div class="col-sm-10">
                                            <div class="row px-3">
                                                <select name="category" id="category" class="form-select col" aria-label="Default select example" onchange="itemChange()">
                                                    <option selected disabled>대분류</option>
                                                    <option value="man_clothes">남성의류</option>
                                                    <option value="woman_clothes">여성의류</option>
                                                    <option value="man_shoes">남성신발</option>
                                                    <option value="woman_shoes">여성신발</option>
                                                    <option value="head">모자</option>
                                                </select>
                                                <!-- <span class="mx-auto"></span> -->
                                                <select name="sub_ctgr" id="sub_ctgr" class="form-select col" aria-label="Default select example" onchange="ctgr_m_change()">
                                                    <option selected disabled>소분류</option>
                                                </select>
                                                <select name="f_style" id="f_style" class="form-select col" aria-label="Default select example">
                                                    <option selected disabled>패션 스타일</option>
                                                    <option value="nomcore">놈코어</option>
                                                    <option value="dandy">댄디</option>
                                                    <option value="layered">레이어드</option>
                                                    <option value="maximalism">맥시멀리즘</option>
                                                    <option value="modern">모던</option>
                                                    <option value="minimalism">미니멀리즘</option>
                                                    <option value="vintage">빈티지</option>
                                                    <option value="street">스트릿</option>
                                                    <option value="sporty">스포티</option>
                                                    <option value="american_casual">아메리칸 캐주얼</option>
                                                    <option value="avant_garde">아방가르드</option>
                                                    <option value="enix">에닉스</option>
                                                    <option value="casual">캐주얼</option>
                                                    <option value="classic">클래식</option>
                                                    <option value="feminine">페미닌</option>
                                                </select>
                                                <input type="hidden" id="ctgr_m" name="ctgr_m" value="">
                                            </div>
                                        </div>
                                        <span id="ctgrhelp" data-check="0"></span>
                                    </div>
                                    

                                    <div class="row mb-3">
                                        <label for="url" class="col col-form-label">연결할 URL</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control w-100" id="url" name="url">
                                            <span id="urlhelp" data-check="0">광고 클릭 시 연결될 상품 페이지를 입력해주세요.</span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="url" class="col col-form-label">일 광고 예산</label>
                                        <div class="col-sm-10">
                                            <div class="row px-3">                                                
                                                <input type="text" class="form-control" id="budget" name="budget"><span class="align-self-center w-auto">원</span>
                                                <div class="form-check col-auto align-self-center ms-3">
                                                    <input class="form-check-input" type="checkbox" value="" id="no_budget" onclick="none_budget();">
                                                    <label class="form-check-label" for="none_budget">
                                                        예산 미설정
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="url" class="col col-form-label">광고 집행 기간</label>
                                        <div class="col-sm-10">
                                            <div class="row px-3">
                                                <input type="date" class="form-control col" id="period_s" name="period_s" onchange="date_check(this);">
                                                <input type="date" class="form-control col" id="period_e" name="period_e" value=" " onchange="date_check(this);">
                                                <div class="form-check col-auto align-self-center ms-3">
                                                    <input class="form-check-input" type="checkbox" value="" id="none_e" onclick="endtime();" checked>
                                                    <label class="form-check-label" for="none_e">
                                                        종료일 미설정
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col col-form-label">광고 이미지</label>
                                        <p style="font-size:0.9rem;">
                                        - 이미지는 <span class="text-primary">*.jpg, *.png</span> 파일만 등록 가능합니다.<br>
                                        - 가이드 안전 영역 내 브랜드 로고 및 텍스트의 배치를 금지합니다.<br>
                                        - 광고이미지는 <span class="text-primary">최소 1장 이상</span> 등록이 가능하나 <span class="text-primary">여러 개를 등록할수록 많은 App에 노출이 됩니다.</span>
                                        </p>
                                        
                                        <div class="area-upload d-flex mb-3">
                                            <div class="preview-native-square" onclick="document.all.img11.click();">
                                                <img id="img11_preview">
                                            </div>
                                            <span class="upload-cencel imgreset" ng-click="resetImage('nativeUpload20', 1)" value="img11" data-con="img11" data-image="img11_preview"></span>
                                            <span class="fs-5 align-self-end">300 X 300 | 1MB</span>
                                            <input id="img11" name="img11[]" type="file" accept=".jpg, .png" title="1:1" class="upload w-0" onchange="handleChange(this);">
                                        </div>
                                        <div class="area-upload d-flex mb-3">
                                            <div class="preview-native-horizontal1" onclick="document.all.img43.click();">
                                                <img id="img43_preview">
                                            </div>
                                            <span class="upload-cencel imgreset" ng-click="resetImage('nativeUpload20', 1)" value="img43" data-con="img43" data-image="img43_preview"></span>
                                            <span class="fs-5 align-self-end">400 X 300 | 1MB</span>
                                            <input id="img43" name="img43[]" type="file" accept=".jpg, .png" title="4:3" class="upload w-0" onchange="handleChange(this);">
                                        </div>
                                        <div class="area-upload d-flex">
                                            <div class="preview-native-vertical" onclick="document.all.img34.click();">
                                                <img id="img34_preview">
                                            </div>
                                            <span class="upload-cencel imgreset" ng-click="resetImage('nativeUpload20', 1)" value="img34" data-con="img34" data-image="img34_preview"></span>
                                            <span class="fs-5 align-self-end">300 X 400 | 1MB</span>
                                            <input id="img34" name="img34[]" type="file" accept=".jpg, .png" title="3:4" class="upload w-0" onchange="handleChange(this);">
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                            <div class="d-flex justify-content-end align-items-center mt-3">
                                <span class="center aligned"><a href="dashboard.php"> 취소 </a></span>
                                <button type="button" class="primary button ms-3" onclick="check_input()">광고 만들기</button>
                            </div>
                            

                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once "../util/scripts.php" ?>
        <?php include_once "../util/adctgr.php" ?>
        <script src="../assets/js/add.js"></script>
        <script type="text/javascript">
            window.onload = function() {
                document.getElementById('period_s').valueAsDate = new Date();
                $('#period_s').data('preStartDate', new Date());
                // if($("#none_e").prop("checked")) {
                    $("#period_e").attr("disabled","disabled");
                    $("#period_e").val("");
                // }
            }

            function none_budget() {
                if(!$("#no_budget").prop("checked")) {
                    $("#budget").removeAttr("disabled");
                    $("#budget").val("");
                } else {
                    $("#budget").attr("disabled","disabled");
                    $("#budget").val("");
                }
            }
            

            function endtime() {
                if(!$("#none_e").prop("checked")) {
                    $("#period_e").removeAttr("disabled");
                    var date = new Date();
                    date.setMonth(date.getMonth() + 1);
                    document.getElementById("period_e").valueAsDate = date;
                    $('#period_e').data('preEndDate', date);
                } else {
                    $("#period_e").attr("disabled","disabled");
                    $("#period_e").val("");
                }
            }

            function date_check(e) {
                var startDate = $('#period_s').val();
                var endDate = $('#period_e').val();
                var preStartDate = $('#period_s').data('preStartDate');
                var preEndDate = $('#period_e').data('preEndDate');
                $('#period_s').data('preStartDate', startDate);
                $('#period_e').data('preEndDate', endDate);
                console.log(preStartDate);
                console.log(preEndDate);
                //-을 구분자로 연,월,일로 잘라내어 배열로 반환
                var startArray = startDate.split('-');
                var endArray = endDate.split('-');   
                //배열에 담겨있는 연,월,일을 사용해서 Date 객체 생성
                var start_date = new Date(startArray[0], startArray[1], startArray[2]);
                var end_date = new Date(endArray[0], endArray[1], endArray[2]);
                    //날짜를 숫자형태의 날짜 정보로 변환하여 비교한다.
                if(start_date.getTime() > end_date.getTime()) {
                    alert("종료날짜보다 시작날짜가 작아야합니다.");
                    console.log(document.getElementById(e.getAttribute('id')).getAttribute('id'));
                    var thisis = document.getElementById(e.getAttribute('id')).getAttribute('id');
                    if(thisis == "period_s") {
                        var psd = new Date(preStartDate);
                        console.log(psd);
                        document.getElementById("period_s").valueAsDate = psd;
                        
                    }
                    if(thisis == "period_e") {
                        var ped = new Date(preEndDate);
                        console.log(ped);
                        document.getElementById("period_e").valueAsDate = ped;
                        
                    }
                    return;
                }
            }
        </script>
        
    </body>
</html>