<?php
    $db_id="root";
    $db_pw="teamnova123";
    $db_name="tentuad";
    $db_domain="localhost"; // 처음에 localhost 넣는 바로 그 곳
    
    $db=mysqli_connect($db_domain, $db_id, $db_pw, $db_name);

    function mq($sql){
        global $db;
        return $db->query($sql);
    }
  // 이후 다른 php 문서에서 include_once "db_con.php"; 한 후,
  // mysql 쿼리문 사용할 때에는 mysqli_connect 부터 쓰는 이런 과정 없이 바로
  // mq(SELECT ~~~~~) 이렇게 사용 가능함
?>