<?php
include_once "../util/db_con.php";
include_once "../util/config.php";

$labels = $_POST['labels']; // 시작일 ~ 종료일 날짜담은 배열 데이터

$sql = mq("SELECT * FROM adList WHERE owner_idx = '$idx' ORDER BY title DESC, period_s ASC");
while($ad = $sql->fetch_array()){
    $imp = []; // 노출 수
    $click = []; // 클릭 수
    $imp_sum = 0; // 기간 동안의 노출 수 총합
    $click_sum = 0; // 기간 동안의 클릭 수 총합

    $adid = $ad['idx'];
    $title = $ad['title'];
    $onoff = $ad['onoff'];
    if($onoff == 1) { 
        $checked = "checked";
    } else { 
        $checked = "";
    }
    $status = $ad['status'];
    switch($status){
        //광고중(0), 광고 중지(1), 광고 운영 불가(예산 초과(2), 검수 반려(3)), 심사중(4)
        case 0:
            $status_show = '광고중';
            break;
        case 1:
            $status_show = '광고 중지';
            break;
        case 2:
            $status_show = '예산 초과';
            break;
        case 3:
            $status_show = '검수 반려';
            break;
        case 4:
            $status_show = '심사중';
            break;
    }
    $budget = $ad['budget'];

    // 날짜별 클릭수, 노출수 불러오기
    for($i = 0; $i < count($labels); $i++){ // 설정된 날짜 갯수만큼 반복
        // $ad = mq("SELECT * FROM adList WHERE idx = '".$adid."'"); // 쿼리문 안 넣으면 반복이 안됨
        
        $date = date("Y-m-d", strtotime($labels[$i]));
        
        $query_imp = mq("SELECT * FROM UserAdClick WHERE adid = '".$adid."' AND isClick='0' AND DATE(actiondate)=DATE('".$date."')");
        $query_click = mq("SELECT * FROM UserAdClick WHERE adid = '".$adid."' AND isClick='1' AND DATE(actiondate)=DATE('".$date."')");
        $imp[$i] = mysqli_num_rows($query_imp); // 노출 수
        $click[$i] = mysqli_num_rows($query_click); // 클릭 수

        $imp_sum += $imp[$i];
        $click_sum += $click[$i];
    }

    $cost = $click_sum*100;
    // $imp = $ad['imp'];
    // $click = $ad['click'];

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
    <td><input class="form-check-input ad_check" type="checkbox" id="check_<?=$adid?>" value="<?=$adid?>"></td>
    <td><?=$title;?></td>
    <td>
        <div class="form-switch">
            <input class="form-check-input ad_switch" type="checkbox" id="switch_<?=$adid?>" value="<?=$adid?>" <?=$checked;?>>
        </div>
    </td>
    <td id="status_<?=$adid?>"><?=$status_show;?></td>
    <td><?=$budget;?></td>
    <td><?=$cost;?></td>
    <td><?=$imp_sum;?></td>
    <td><?=$click_sum;?></td>
    <td><?php if($imp_sum==0) { echo '-';} else { echo round(($click_sum/$imp_sum)*100).'%';}?></td>
    <td><?php if($imp_sum==0) { echo '-';} else { echo round($cost/$imp_sum);}?></td>
    <td><?php if($click_sum==0) { echo '-';} else { echo round($cost/$click_sum);}?></td>
    <td><?=$start.'~'.$end;?></td>
</tr>
<?php
}
?>
<script>
// 테이블 데이터 채울 때 같이 해야 스위치 클릭 이벤트가 먹힘
// 여기서 같이 안 넣고 dashboard.js에 넣으면 이벤트 안 먹힘
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
        
        $.ajax({ // 광고 지표(페르소나별) 테이블 데이터 불러오기
            url : "./ad_status.php",
            type : "POST",
            // traditional : true,
            dataType : "JSON",
            data : {
                "adid" : adid,
                "onoff" : onoff
            },
            success : function(data){
                if(data){
                    $("#status_"+adid).text(data.status);
                }
            }
        });
    });
});
</script>