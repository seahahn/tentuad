<?php
    include_once "../util/config.php";
    include_once "../util/db_con.php";
    include_once "../util/s3.php";

    $s3 = new aws_s3; // s3 객체 생성
    $s3path = "images/"; // s3 버킷 내에 파일 저장할 폴더 경로
    $bucket = $s3->bucket; // 버킷 이름
    $s3url = $s3->url; // 내 s3 url

    $adTitle = $_POST['adTitle'];
    $category = $_POST['category']; // 게시판 대분류
    $sub_ctgr = $_POST['sub_ctgr']; // 게시판 소분류
    $url = $_POST['url'];
    $period_s = $_POST['period_s'];
    if(isset($_POST['period_e']) && $_POST['period_e'] != " ") {
        $period_e = $_POST['period_e'];
    } else {
        $period_e = '9999-12-31 23:59:59';
    }
    $img11 = "none";
    $img43 = "none";
    $img34 = "none";

    // $idx = $idx;
    // $email = $email;
    // $name = $name;
    // $date = date('Y-m-d H:i:s');
    
    $query = mq("SELECT * FROM adList");
    $exists = mysqli_num_rows($query);
    
    if($exists == 0)    {
        mq("ALTER TABLE adList AUTO_INCREMENT = 1"); // 게시판에 게시물 없는 경우 auto_increment 값 초기화
    }

    print_r($_FILES['img11']['name'][0]);

    if($_FILES) {
        $baseDownFolder = "../images/"; // 로컬 컴퓨터 내에 임시로 파일 저장해둘 위치

        if(count($_FILES['img11']['name']) > 0 && $_FILES['img11']['name'][0] != "") {
            // 실제 파일명 
            $real_filename = $_FILES['img11']['name'][0];

            // 파일 확장자 체크 
            $nameArr = explode(".", $real_filename);
            $extension = $nameArr[sizeof($nameArr) - 1]; 

            // 임시 파일명 (현재시간_랜덤수.파일 확장자) - 파일명 중복될 경우를 대비해 임시파일명을 덧붙여 저장하려함 
            $tmp_filename = time() . '_' . mt_rand(0,99999) . '.' . strtolower($extension);

            if(!move_uploaded_file($_FILES["img11"]["tmp_name"][0], $baseDownFolder.$tmp_filename) ) {
                echo 'upload error';
            }

            // 파일 권한 변경 (생략가능_추후 변경할 수 있게 권한 변경함) 
            chmod($baseDownFolder.$tmp_filename, 0755);

            // 첨부파일 s3에 저장
            $s3->put($bucket, $baseDownFolder.$tmp_filename, $s3path.$tmp_filename);

            // s3에 파일 저장 및 DB에 파일 정보 저장한 후 로컬에 저장시켰던 파일 삭제
            global $img11;
            $img11 = $s3url.$s3path.$tmp_filename;
            if(!unlink($baseDownFolder.$tmp_filename)) {
                echo "file delete failed.\n";
            }
        }

        if(count($_FILES['img43']['name']) > 0 && $_FILES['img43']['name'][0] != "") {
            // 실제 파일명 
            $real_filename = $_FILES['img11']['name'][0];

            // 파일 확장자 체크 
            $nameArr = explode(".", $real_filename);
            $extension = $nameArr[sizeof($nameArr) - 1]; 

            // 임시 파일명 (현재시간_랜덤수.파일 확장자) - 파일명 중복될 경우를 대비해 임시파일명을 덧붙여 저장하려함 
            $tmp_filename = time() . '_' . mt_rand(0,99999) . '.' . strtolower($extension);

            if(!move_uploaded_file($_FILES["img11"]["tmp_name"][0], $baseDownFolder.$tmp_filename) ) {
                echo 'upload error';
            }

            // 파일 권한 변경 (생략가능_추후 변경할 수 있게 권한 변경함) 
            chmod($baseDownFolder.$tmp_filename, 0755);

            // 첨부파일 s3에 저장
            $s3->put($bucket, $baseDownFolder.$tmp_filename, $s3path.$tmp_filename);

            // s3에 파일 저장 및 DB에 파일 정보 저장한 후 로컬에 저장시켰던 파일 삭제
            global $img43;
            $img43 = $s3url.$s3path.$tmp_filename;
            if(!unlink($baseDownFolder.$tmp_filename)) {
                echo "file delete failed.\n";
            }
        }

        if(count($_FILES['img34']['name']) > 0 && $_FILES['img34']['name'][0] != "") {
            // 실제 파일명 
            $real_filename = $_FILES['img11']['name'][0];

            // 파일 확장자 체크 
            $nameArr = explode(".", $real_filename);
            $extension = $nameArr[sizeof($nameArr) - 1]; 

            // 임시 파일명 (현재시간_랜덤수.파일 확장자) - 파일명 중복될 경우를 대비해 임시파일명을 덧붙여 저장하려함 
            $tmp_filename = time() . '_' . mt_rand(0,99999) . '.' . strtolower($extension);

            if(!move_uploaded_file($_FILES["img11"]["tmp_name"][0], $baseDownFolder.$tmp_filename) ) {
                echo 'upload error';
            }

            // 파일 권한 변경 (생략가능_추후 변경할 수 있게 권한 변경함) 
            chmod($baseDownFolder.$tmp_filename, 0755);

            // 첨부파일 s3에 저장
            $s3->put($bucket, $baseDownFolder.$tmp_filename, $s3path.$tmp_filename);

            // s3에 파일 저장 및 DB에 파일 정보 저장한 후 로컬에 저장시켰던 파일 삭제
            global $img34;
            $img34 = $s3url.$s3path.$tmp_filename;
            if(!unlink($baseDownFolder.$tmp_filename)) {
                echo "file delete failed.\n";
            }
        }
        
    }

    // DB 저장
    $mq = mq("INSERT adList SET
        title = '".$adTitle."',
        owner_idx = '".$idx."',
        ctgr_b = '".$category."',
        ctgr_s = '".$sub_ctgr."',
        period_s = '".$period_s."',
        period_e = '".$period_e."',
        adurl = '".$url."',
        img11 = '".$img11."',
        img43 = '".$img43."',
        img34 = '".$img34."'
        ");
?>
    <script>
        alert("광고가 등록되었습니다.");
        location.href = 'dashboard.php';
    </script>