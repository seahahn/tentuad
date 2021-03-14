<?php
include_once "../util/db_con.php";
include_once "../util/config.php";

$labels = $_POST['labels']; // 시작일 ~ 종료일 날짜담은 배열 데이터

// 광고 지표(페르소나별) 테이블의 데이터 채우기 위한 값들 불러오기
$ps = ["inssa", "ps1", "ps2", "ps3", "ps4"]; // 페르소나 목록을 담은 배열
$imp_ps = []; // 페르소나별 노출 수 배열에 담기. 테이블에 데이터 표시할 때 순차적으로 불러오기 위함.
$click_ps = []; // 페르소나별 클릭 수 배열에 담기. 테이블에 데이터 표시할 때 순차적으로 불러오기 위함.
for($i=0; $i<count($ps); $i++){
    $title = $ps[$i]; // 페르소나명
    $imp_ps[$i] = 0; // 페르소나별 노출 수
    $click_ps[$i] = 0; // 페르소나별 클릭 수

    // 날짜별 클릭수, 노출수 불러오기
    for($j = 0; $j < count($labels); $j++){ // 설정된 날짜 갯수만큼 반복
        $date = date("Y-m-d", strtotime($labels[$j]));
        
        if(!isset($_POST['adidx'])) { // 전체 광고에 대한 데이터 보여주는 경우
            $query_imp = mq("SELECT * FROM UserAdClick WHERE owner_idx = '$idx' AND isClick='0' AND ps='$ps[$i]' AND DATE(actiondate)=DATE('".$date."')");
            $query_click = mq("SELECT * FROM UserAdClick WHERE owner_idx = '$idx' AND isClick='1' AND ps='$ps[$i]' AND DATE(actiondate)=DATE('".$date."')");
        } else { // 개별 광고에 대한 데이터 보여주는 경우
            $adid = $_POST['adidx'];
            
            $query_imp = mq("SELECT * FROM UserAdClick WHERE adid = '".$adid."' AND isClick='0' AND ps='$ps[$i]' AND DATE(actiondate)=DATE('".$date."')");
            $query_click = mq("SELECT * FROM UserAdClick WHERE adid = '".$adid."' AND isClick='1' AND ps='$ps[$i]' AND DATE(actiondate)=DATE('".$date."')");
        }
        
        $imp[$j] = mysqli_num_rows($query_imp); // 노출 수
        $click[$j] = mysqli_num_rows($query_click); // 클릭 수

        $imp_ps[$i] += $imp[$j];
        $click_ps[$i] += $click[$j];
    }
    $cost = $click_ps[$i]*100;
    $imp_show = $imp_ps[$i];
    $click_show = $click_ps[$i];
?>
<tr>
    <td><?=$title;?></td>
    <td><?=$cost;?></td>
    <td><?=$imp_show;?></td>
    <td><?=$click_show;?></td>
    <td><?php if($imp_show==0) { echo '-';} else { echo round(($click_show/$imp_show)*100).'%';}?></td>
    <td><?php if($imp_show==0) { echo '-';} else { echo round($cost/$imp_show);}?></td>
    <td><?php if($click_show==0) { echo '-';} else { echo round($cost/$click_show);}?></td>
</tr>
<?php
}
?>