<?php
include_once "../util/db_con.php";
include_once "../util/config.php";

$labels = $_POST['labels'];
$adlist = mq("SELECT * FROM adList WHERE owner_idx = '".$idx."'");

$imp = [];
$click = [];
// 날짜별 클릭수, 노출수 불러오기
for($i = 0; $i < count($labels); $i++){ // 설정된 날짜 갯수만큼 반복
    
    $adlist = mq("SELECT * FROM adList WHERE owner_idx = '".$idx."'"); // 쿼리문 안 넣으면 반복이 안됨
    
    while($impclick = $adlist->fetch_array()){ // 해당 날짜에 기록된 광고 노출/클릭 수 불러오기
        
        $date = date("Y-m-d", strtotime($labels[$i]));
        
        $query_imp = mq("SELECT * FROM UserAdClick WHERE owner_idx = '".$impclick['owner_idx']."' AND isClick='0' AND DATE(actiondate)=DATE('".$date."')");
        $query_click = mq("SELECT * FROM UserAdClick WHERE owner_idx = '".$impclick['owner_idx']."' AND isClick='1' AND DATE(actiondate)=DATE('".$date."')");
        $imp[$i] = mysqli_num_rows($query_imp); // 노출 수
        $click[$i] = mysqli_num_rows($query_click); // 노출 수
        
    }
    
}

$ret['imp'] = $imp;
$ret['click'] = $click;

echo json_encode($ret);

?>