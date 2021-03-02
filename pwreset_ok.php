<?php
include_once "./util/db_con.php";

$email = $_POST['email'];
$pw = $_POST['password'];
$hash = $_POST['hash'];
$sql = "SELECT * FROM aduser WHERE email='$email'";
$result = mq($sql);
$row = mysqli_fetch_array($result);
$db_hash = $row['hashv'];

if($hash == $db_hash) {
    mq("UPDATE aduser SET
                pw = '$pw',
                hashv = ''
                WHERE email='$email'
                ");
}
?>