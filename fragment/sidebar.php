<aside id="sidebar">
    <div class="sidebar">
    <nav id="gnb">
        <!-- 사이드바 헤더 부분 시작-->
        <h2 class="hidden">Menu</h2>
        <div class="border-bottom">
            <a href="../info/dashboard.php" class="active">
                <h1 class="logo">TENTUPLAY</h1>
                <h2 class="text-center mb-3">광고주 센터</h2>
            </a>
        </div>
        <!-- 사이드바 헤더 부분 끝-->

        <!-- 사이드바 내용 부분 시작-->
        <ul class="global navigation">
            <li>
                <span data-v-4bcec590="" class="exact active">광고 목록</span>
                <div aria-expanded="true">
                <ul class="submenu level one">
                <?php
                $sql = mq("SELECT * FROM adList WHERE email='".$email."' ORDER BY title DESC, period_s ASC");
                while($ad = $sql->fetch_array()){
                ?>
                    <li data-v-4bcec590="">
                        <a data-v-4bcec590="" href="#" aria-current="page" class=""><span data-v-4bcec590=""><?=$ad["title"]?> </span></a>
                    </li>
                <?php
                }
                ?>
                    <!-- <li data-v-4bcec590="">
                        <a data-v-4bcec590="" href="#" aria-current="page" class=""><span data-v-4bcec590="">광고 1 </span></a>
                    </li>
                    <li data-v-4bcec590="">
                        <a data-v-4bcec590="" href="#" class=""><span data-v-4bcec590="">광고 2</span></a>
                    </li> -->
                </ul>
                </div>
            </li>
        </ul>
        <!-- 사이드바 내용 부분 끝-->
        <button type="button" class="btn btn-lg btn-warning mt-3 justify-content-center w-100 rounded-0" onclick="location.href='add.php'"><span class="text-light">+ 광고 만들기</span></button>
    </nav>
    </div>
</aside>