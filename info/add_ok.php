<?php
    include_once "../util/config.php";
    include_once "../util/db_con.php";
    include_once "../util/s3.php";

    $s3 = new aws_s3; // s3 객체 생성
    $s3path = "images/"; // s3 버킷 내에 파일 저장할 폴더 경로
    $bucket = $s3->bucket; // 버킷 이름
    $s3url = $s3->url; // 내 s3 url

    $adTitle = $_POST['adTitle'];
    $category = $_POST['category']; // 상품 카테고리 대분류
    $ctgr_m = $_POST['ctgr_m']; // 상품 카테고리 중분류(의류 -> 아우터/상의/하의)
    $sub_ctgr = $_POST['sub_ctgr']; // 상품 카테고리 소분류
    $f_style = $_POST['f_style']; // 상품의 패션 스타일(댄디, 아방가르드 등)
    $url = $_POST['url']; // 광고 클릭 시 연결할 URL
    // 예산 설정되어 있으면 가져오고 아니면 0
    if(isset($_POST['budget']) && $_POST['budget'] != "") {
        $budget = $_POST['budget'];
    } else {
        $budget = 0;
    }
    $period_s = $_POST['period_s']; // 광고 생성일(시작일)
    // 광고 종료일 설정되어 있으면 가져오고 아니면 종료일 없음(9999-12-31 로 넣음)
    if(isset($_POST['period_e']) && $_POST['period_e'] != " ") {
        $period_e = $_POST['period_e'];
    } else {
        $period_e = '9999-12-31 23:59:59';
    }
    // 광고 상품 이미지 첨부 전에 none 값으로 초기화
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

    // 이미지 파일 첨부 구현(최소 1개)
    if($_FILES) {
        $baseDownFolder = "../images/"; // 로컬 컴퓨터 내에 임시로 파일 저장해둘 위치

        // 1:1(300*300) 이미지 첨부 구현
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

        // 4:3(400*300) 이미지 첨부 구현
        if(count($_FILES['img43']['name']) > 0 && $_FILES['img43']['name'][0] != "") {
            // 실제 파일명 
            $real_filename = $_FILES['img43']['name'][0];

            // 파일 확장자 체크 
            $nameArr = explode(".", $real_filename);
            $extension = $nameArr[sizeof($nameArr) - 1]; 

            // 임시 파일명 (현재시간_랜덤수.파일 확장자) - 파일명 중복될 경우를 대비해 임시파일명을 덧붙여 저장하려함 
            $tmp_filename = time() . '_' . mt_rand(0,99999) . '.' . strtolower($extension);

            if(!move_uploaded_file($_FILES["img43"]["tmp_name"][0], $baseDownFolder.$tmp_filename) ) {
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

        // 3:4(300*400) 이미지 첨부 구현
        if(count($_FILES['img34']['name']) > 0 && $_FILES['img34']['name'][0] != "") {
            // 실제 파일명 
            $real_filename = $_FILES['img34']['name'][0];

            // 파일 확장자 체크 
            $nameArr = explode(".", $real_filename);
            $extension = $nameArr[sizeof($nameArr) - 1]; 

            // 임시 파일명 (현재시간_랜덤수.파일 확장자) - 파일명 중복될 경우를 대비해 임시파일명을 덧붙여 저장하려함 
            $tmp_filename = time() . '_' . mt_rand(0,99999) . '.' . strtolower($extension);

            if(!move_uploaded_file($_FILES["img34"]["tmp_name"][0], $baseDownFolder.$tmp_filename) ) {
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
        budget = '".$budget."',
        owner_idx = '".$idx."',
        ctgr_b = '".$category."',
        ctgr_m = '".$ctgr_m."',
        ctgr_s = '".$sub_ctgr."',
        f_style = '".$f_style."',
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
        location.href = './dashboard.php';
    </script>