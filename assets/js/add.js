/* 필수 입력 채우지 않았을 경우 경고창 띄우기*/
function check_input() {
    if(!$("#adTitle").val()){
        alert("광고 제목을 입력해주세요.");                    
        $("#adTitle").focus();
        return;
    }

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

    if(!$("#f_style").val()){
        alert("패션 스타일을 설정해주세요.");
        $("#f_style").focus();
        return;
    }

    if(!$("#url").val()){
        alert("상품 페이지 URL을 입력해주세요.");
        $("#url").focus();
        return;
    }

    if(!$("#budget").val() && !$("#no_budget").prop("checked")){
        alert("광고 예산을 입력해주세요.");                    
        $("#budget").focus();
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

// 광고 예산 3자리 단위마다 콤마 생성
function addCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
$("#budget").on("keyup", function() {
    $(this).val(addCommas($(this).val().replace(/[^0-9]/g,"")));
});

// 이미지 선택하여 첨부하면서 미리보기 이미지도 넣어줌
// 이미지 규격에 맞지 않으면 경고 메시지 띄움
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
        // console.log(filePic);
        // console.log(fileType);
        // console.log(fileSize);
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
                    if (width == 300 && height == 300) { //Judge file pixels
                        //upload image 
                        $('#img11_preview').attr('src', data);
                    } else {
                        alert("이미지 픽셀 크기가 300X300이 아닙니다!");
                        return;
                    }
                } else if(id == "img43") {
                    if (width == 400 && height == 300) { //Judge file pixels
                        //upload image 
                        $('#img43_preview').attr('src', data);
                    } else {
                        alert("이미지 픽셀 크기가 400X300이 아닙니다!");
                        return;
                    }
                } else if(id == "img34") {
                    if (width == 300 && height == 400) { //Judge file pixels
                        //upload image 
                        $('#img34_preview').attr('src', data);
                    } else {
                        alert("이미지 픽셀 크기가 300X400이 아닙니다!");
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

// 이미지 우측 상단 X 버튼 클릭 시 이미지 첨부 삭제 및 미리보기 제거
$(function() {
    $(".imgreset").click(function(){
        var file = $(this).data("con");
        var image = $(this).data("image");
        // console.log(file);
        // console.log(image);

        $("#"+file).val("");
        $("#"+image).attr("src", "");

        // console.log($(file).val());
    });
});