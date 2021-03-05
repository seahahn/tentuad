<?php
include_once "../util/db_con.php";
include_once "../util/config.php";

$labels = $_POST['labels'];
// $labels = ["2021-02-27", "2021-02-28", "2021-03-01", "2021-03-02", "2021-03-03", "2021-03-04", "2021-03-05", "2021-03-06"];
$adlist = mq("SELECT * FROM adList WHERE owner_idx = '".$idx."'");
// $adlist = mq("SELECT * FROM adList WHERE owner_idx = '16'");
$imp = [];
$click = [];
// 날짜별 클릭수, 노출수 불러오기
for($i = 0; $i < count($labels); $i++){ // 설정된 날짜 갯수만큼 반복
    // echo 'for '.$i;
    // echo '<br>';
    $adlist = mq("SELECT * FROM adList WHERE owner_idx = '".$idx."'"); // 쿼리문 안 넣으면 반복이 안됨
    // $adlist = mq("SELECT * FROM adList WHERE owner_idx = '16'"); // 쿼리문 안 넣으면 반복이 안됨
    while($impclick = $adlist->fetch_array()){ // 해당 날짜에 기록된 광고 노출/클릭 수 불러오기
        // echo $i;
        // echo '<br>';
        // echo 'owner_idx '.$impclick['owner_idx'];
        // echo '<br>';
        // echo 'idx '.$impclick['idx'];
        // echo '<br>';
        $date = date("Y-m-d", strtotime($labels[$i]));
        // echo 'date :'.$date;
        // echo '<br>';
        // $query = mq("SELECT * FROM UserAdClick WHERE owner_idx = '".$impclick['owner_idx']."' AND DATE(actiondate)='".$date."'");
        $query_imp = mq("SELECT * FROM UserAdClick WHERE owner_idx = '".$impclick['owner_idx']."' AND DATE(actiondate)='".$date."'");
        $query_click = mq("SELECT * FROM UserAdClick WHERE owner_idx = '".$impclick['owner_idx']."' AND isClick='1' AND DATE(actiondate)=DATE('".$date."')");
        $imp[$i] = mysqli_num_rows($query_imp); // 노출 수
        $click[$i] = mysqli_num_rows($query_click); // 노출 수
        // echo 'mysqli_num_rows imp :'.$imp[$i];
        // echo '<br>';
        // echo 'mysqli_num_rows click:'.$click[$i];
        // echo '<br>';
        // $clicksql = mysqli_fetch_array($query);
        // if(isset($clicksql['isClick'])) {
        //     $click[$i] = $clicksql['isClick'];
        // } else {
        //     $click[$i] = 0;
        // }
        
        // print_r($clicksql['isClick']);
        // echo '<br>';
    }
    // echo 'imp '.$i." :".$imp[$i];
    // echo '<br>';
    // echo 'click '.$i." :".$click[$i];
    // echo '<br>';
}
// for($i=0; $i<count($click); $i++){
//     if(!isset($clicksql['isClick'])) $click[$i] = 0;
// }
$ret['imp'] = $imp;
$ret['click'] = $click;
echo json_encode($ret);
// print_r($labels);
// echo '<br>';
// echo count($labels);
// echo '<br>';
// print_r($imp);
// echo '<br>';
// print_r($click);
?>