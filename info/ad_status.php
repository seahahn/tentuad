<?php
include_once "../util/db_con.php";
include_once "../util/config.php";

$adid = $_POST['adid'];
$onoff = $_POST['onoff'];

// $sql = mq("SELECT * FROM adList WHERE idx = '$adid'");
// $result = mysqli_fetch_array($sql);

mq("UPDATE adList SET onoff='".$onoff."' WHERE idx='$adid'"); // 스위치 상태에 따른 DB 내 광고 ON/OFF 변경

if($onoff == 0) {
    $status = 1;
    mq("UPDATE adList SET status='".$status."' WHERE idx='$adid'"); // 스위치 상태에 따른 DB 내 광고 상태(status) 변경
} else {
    $status = 0;
    mq("UPDATE adList SET status='".$status."' WHERE idx='$adid'"); // 스위치 상태에 따른 DB 내 광고 상태(status) 변경
}

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

$ret['status'] = $status_show;

echo json_encode($ret);

?>