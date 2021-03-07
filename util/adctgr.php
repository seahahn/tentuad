<script>
        function itemChange() {
            var selectCtgr = $("#category").val();
            var sub;

            var man_clothes = ['<option selected disabled>소분류</option>',
                '<option value="man_knitwear">니트</option>',
                '<option value="man_pants_long">긴바지</option>',
                '<option value="man_pants_short">반바지</option>',
                '<option value="man_shirts">셔츠</option>',
                '<option value="man_sweater">스웨터</option>',
                '<option value="man_jacket">재킷</option>',
                '<option value="man_jumper">점퍼</option>',
                '<option value="man_jean">청바지</option>',
                '<option value="man_cardigan">카디건</option>',
                '<option value="man_coat">코트</option>',
                '<option value="man_sportswear_top">트레이닝복(상의)</option>',
                '<option value="man_sportswear_bottom">트레이닝복(하의)</option>',
                '<option value="man_tshirts_long">티셔츠(긴팔)</option>',
                '<option value="man_tshirts_short">티셔츠(반팔)</option>'];

            var woman_clothes = ['<option selected disabled>소분류</option>',
                '<option value="woman_knitwear">니트</option>',
                '<option value="woman_leggings">레깅스</option>',
                '<option value="woman_pants_long">긴바지</option>',
                '<option value="woman_pants_short">반바지</option>',
                '<option value="woman_blouse">블라우스/셔츠</option>',
                '<option value="woman_sweater">스웨터</option>',
                '<option value="woman_skirts_long">스커트(롱)</option>',
                '<option value="woman_skirts_short">스커트(숏)</option>',
                '<option value="woman_onepiece">원피스</option>',
                '<option value="woman_jacket">재킷</option>',
                '<option value="woman_jumper">점퍼</option>',
                '<option value="woman_jean">청바지</option>',
                '<option value="woman_cardigan">카디건</option>',
                '<option value="woman_coat">코트</option>',
                '<option value="woman_sportswear_top">트레이닝복(상의)</option>',
                '<option value="woman_sportswear_bottom">트레이닝복(하의)</option>',
                '<option value="woman_shirts_long">티셔츠(긴팔)</option>',
                '<option value="woman_shirts_short">티셔츠(반팔)</option>'];

            var man_shoes = ['<option selected disabled>소분류</option>',
                '<option value="man_boots">부츠</option>',
                '<option value="man_runningshoes">운동화</option>',
                '<option value="man_shoes_etc">기타</option>'];

            var woman_shoes = ['<option selected disabled>소분류</option>',
                '<option value="woman_boots">부츠</option>',
                '<option value="woman_runningshoes">운동화</option>',
                '<option value="woman_heels">힐/펌프스</option>',
                '<option value="woman_shoes_etc">기타</option>'];

            var head = ['<option selected disabled>소분류</option>',
            '<option value="beanie">비니</option>',
            '<option value="baseballcap">야구모자</option>'];

            if(selectCtgr == "man_clothes") {
                sub = man_clothes;        
            }
            if(selectCtgr == "woman_clothes") {
                sub = woman_clothes;        
            }
            if(selectCtgr == "man_shoes") {
                sub = man_shoes;
            }
            if(selectCtgr == "woman_shoes") {
                sub = woman_shoes;
            }
            if(selectCtgr == "head") {
                sub = head;
            }

            $("#sub_ctgr").empty();

            for(var i = 0; i < sub.length; i++) {        
                var sub_opt = $(sub[i]);
                $("#sub_ctgr").append(sub_opt);
            }
        }

        function ctgr_m_change() {
            var selectCtgr = $("#sub_ctgr").val();
            var ctgr_m;

            switch(selectCtgr) {
            // 아우터
                case "man_jacket":
                    ctgr_m = "outer";
                    break;
                case "man_jumper":
                    ctgr_m = "outer";
                    break;
                case "man_cardigan":
                    ctgr_m = "outer";
                    break;
                case "man_coat":
                    ctgr_m = "outer";
                    break;
                case "woman_jacket":
                    ctgr_m = "outer";
                    break;
                case "woman_jumper":
                    ctgr_m = "outer";
                    break;
                case "woman_cardigan":
                    ctgr_m = "outer";
                    break;
                case "woman_coat":
                    ctgr_m = "outer";
                    break;
            // 상의
                case "man_knitwear":
                    ctgr_m = "top";
                    break;
                case "man_shirts":
                    ctgr_m = "top";
                    break;
                case "man_sweater":
                    ctgr_m = "top";
                    break;
                case "man_sportswear_top":
                    ctgr_m = "top";
                    break;
                case "man_tshirts_long":
                    ctgr_m = "top";
                    break;
                case "man_tshirts_short":
                    ctgr_m = "top";
                    break;
                case "woman_knitwear":
                    ctgr_m = "top";
                    break;
                case "woman_blouse":
                    ctgr_m = "top";
                    break;
                case "woman_sweater":
                    ctgr_m = "top";
                    break;
                case "woman_onepiece":
                    ctgr_m = "top";
                    break;
                case "woman_sportswear_top":
                    ctgr_m = "top";
                    break;
                case "woman_shirts_long":
                    ctgr_m = "top";
                    break;
                case "woman_shirts_short":
                    ctgr_m = "top";
                    break;
            // 하의
                case "man_pants_long":
                    ctgr_m = "outer";
                    break;
                case "man_pants_short":
                    ctgr_m = "outer";
                    break;
                case "man_jean":
                    ctgr_m = "outer";
                    break;
                case "man_sportswear_bottom":
                    ctgr_m = "outer";
                    break;
                case "woman_leggings":
                    ctgr_m = "outer";
                    break;
                case "woman_pants_long":
                    ctgr_m = "outer";
                    break;
                case "woman_pants_short":
                    ctgr_m = "outer";
                    break;
                case "woman_skirts_long":
                    ctgr_m = "outer";
                    break;
                case "woman_skirts_short":
                    ctgr_m = "outer";
                    break;
                case "woman_jean":
                    ctgr_m = "outer";
                    break;
                case "woman_sportswear_bottom":
                    ctgr_m = "outer";
                    break;
            }

            $("#ctgr_m").val(ctgr_m);
        }
        </script>