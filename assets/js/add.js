/* 필수 입력 채우지 않았을 경우 경고창 띄우기*/
function check_input() {
    if(!$("#adTitle").val()){
        alert("광고 제목을 입력해주세요.");                    
        $("#adTitle").focus();
        return;
    }

    console.log($("#category").val());
    console.log($("#sub_ctgr").val());
    if(!$("#category").val()){
        alert("카테고리 대분류를 설정해주세요.");
        $("#category").focus();
        return;
    }

    if(!$("#sub_ctgr").val()){
        alert("카테고리 소분류를 설정해주세요.");
        $("#sub_ctgr").focus();
        return;
    }

    if(!$("#url").val()){
        alert("상품 페이지 URL을 입력해주세요.");
        $("#url").focus();
        return;
    }

    var startDate = $('#period_s').val();
    var endDate = $('#period_e').val();
    //-을 구분자로 연,월,일로 잘라내어 배열로 반환
    var startArray = startDate.split('-');
    var endArray = endDate.split('-');   
    //배열에 담겨있는 연,월,일을 사용해서 Date 객체 생성
    var start_date = new Date(startArray[0], startArray[1], startArray[2]);
    var end_date = new Date(endArray[0], endArray[1], endArray[2]);
        //날짜를 숫자형태의 날짜 정보로 변환하여 비교한다.
    if(start_date.getTime() > end_date.getTime()) {
        alert("종료날짜보다 시작날짜가 작아야합니다.");
        return;
    }

    console.log($("#img11").val());
    if($('#img11').val()=="" && $('#img43').val()=="" && $('#img34').val()==""){
        alert("이미지를 최소 1장 업로드해주세요.");
        return;
    }

    document.formAdd.submit();
}

function handleChange(file) {
    // if (input.files && input.files[0]) {
    //     var reader = new FileReader();
    //     reader.onload = function (e) {
    //         $('#img11_preview').attr('src', e.target.result);
    //     }
    //     reader.readAsDataURL(input.files[0]);
    // }
    
    var id = $(file).attr('id');
    
    var fileTypes = [".jpg", ".png"]; //The image format we need
    var filePath = file.value;
    // console.log(filePath);
    if (filePath) {
        var filePic = file.files[0]; //Selected file content--image
        var fileType = filePath.slice(filePath.indexOf(".")); //Select the format of the file
        var fileSize = file.files[0].size; //Select the file size
        console.log(filePic);
        console.log(fileType);
        console.log(fileSize);
        if (fileTypes.indexOf(fileType) == -1) { //Determine whether the file format meets the requirements
            alert("올바른 이미지 파일 확장자가 아닙니다!");
            return;
        }
        if (fileSize > 1024 * 1024) {
            alert("이미지 크기가 1M를 초과합니다!");
            return;
        }
        var reader = new FileReader();
        reader.readAsDataURL(filePic);
        reader.onload = function (e) {
            var data = e.target.result; // Load the image to get the true width and height of the image
            var image = new Image();
            image.onload = function () {
                var width = image.width;
                var height = image.height;
                if(id == "img11") {
                    if (width == 200 && height == 200) { //Judge file pixels
                    //upload image 
                    $('#img11_preview').attr('src', data);
                    } else {
                        alert("이미지 픽셀 크기가 200X200이 아닙니다!");
                        return;
                    }
                } else if(id == "img43") {
                    if (width == 800 && height == 600) { //Judge file pixels
                    //upload image 
                    $('#img43_preview').attr('src', data);
                    } else {
                        alert("이미지 픽셀 크기가 800X600이 아닙니다!");
                        return;
                    }
                } else if(id == "img34") {
                    if (width == 600 && height == 800) { //Judge file pixels
                    //upload image 
                    $('#img34_preview').attr('src', data);
                    } else {
                        alert("이미지 픽셀 크기가 600X800이 아닙니다!");
                        return;
                    }
                }
            };
            image.src = data;
        };
    } else {
        return;
    }
}