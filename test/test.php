<?php
// 이전 로그인에서 '이메일 저장하기' 체크했다면 쿠키에 저장된 정보를 불러옴
if(isset($_COOKIE['cookieemail'])){
	$cookieemail = $_COOKIE['cookieemail']; // 이메일 입력란에 넣을 값
	$rememberInfo = $_COOKIE['rememberInfo'];
	if($rememberInfo == 'on') $checked = 'checked'; // '이메일 저장하기' 좌측 체크박스에 체크함

} else {
	$cookieemail = '';
	$rememberInfo = '';
	$checked = '';
}    
?>
<!DOCTYPE html>
<html lang="ko">
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
		<div id="page-wrapper">
			<!-- Header -->
			<div class="mb-4" id="header">
				
			</div>

			<!-- 메인 영역-->
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
					<tr>
						<td><input class="form-check-input ad_check" type="checkbox"></td>
						<td>tett</td>
						<td>
							<div class="form-switch">
								<input class="form-check-input ad_switch" type="checkbox">
							</div>
						</td>
						<td id="status_">sss</td>
						<td>asd</td>
						<td>aaa</td>
						<td>cc</td>
						<td>c</td>
						<td>a</td>
						<td>ci</td>
						<td>cc</td>
						<td>start</td>
					</tr>
				</tbody>
			</table>
			<div class="form-switch">
			<input class="form-check-input ad_switch" type="checkbox">
			</div>
			<!-- Footer -->
			<div class="mt-4" id="footer">
				
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

			<script>
				$(document).ready(function() {
    $(".ad_switch").on("click", function() {
        var adid = $(this).val();
        var check = $(this).is(":checked");
        console.log("check");
        if(!check) {
            var onoff = 0;
        } else {
            var onoff = 1;
        }
        
        // $.ajax({ // 광고 지표(페르소나별) 테이블 데이터 불러오기
        //     url : "./ad_status.php",
        //     type : "POST",
        //     // traditional : true,
        //     dataType : "JSON",
        //     data : {
        //         "adid" : adid,
        //         "onoff" : onoff
        //     },
        //     success : function(data){
        //         if(data){
        //             $("#status_"+adid).text(data.status);
        //         }
        //     }
        // });
    });
});
			</script>
	</body>
</html>