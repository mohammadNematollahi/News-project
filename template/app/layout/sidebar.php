<div class="sidebars-area">

    <div class="single-sidebar-widget editors-pick-widget">
        <h6 class="title">انتخاب سردبیر</h6>
        <?php
        if (isset($newsSelected)) { ?>
            <div class="editors-pick-post">
                <div class="feature-img-wrap relative">
                    <div class="feature-img relative">
                        <div class="overlay overlay-bg"></div>
                        <img class="img-fluid" src="<?= asset($newsSelected[0]->image) ?>" alt="">
                    </div>
                    <ul class="tags">
                        <li><a href="#"><?= $newsSelected[0]->nameCat ?></a></li>
                    </ul>
                </div>
                <div class="details">
                    <a href="image-post.html">
                        <h4 class="mt-20"><?= $newsSelected[0]->title ?></h4>
                    </a>
                    <ul class="meta">
                        <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                        <li><a href="#"><?= jaliliDate($newsSelected[0]->created_at) ?><span class="lnr lnr-calendar-full"></span></a></li>
                        <li><a href="#"><?= $newsSelected[0]->countComments ?><span class="lnr lnr-bubble"></span></a></li>
                    </ul>
                    <p class="excert">
                       <?= $newsSelected[0]->summary ?>
                    </p>
                </div>
            </div>
        <? }
        ?>
    </div>

    <?php
    if (isset($baners)) { ?>

        <div class="single-sidebar-widget ads-widget">
            <img class="img-fluid" src="<?= asset($baners[0]->img) ?>" alt="">
        </div>
    <? }
    ?>

    <div class="single-sidebar-widget most-popular-widget">
        <h6 class="title">پر بحث ترین ها</h6>
        <?php for ($i = 0; $i < count($mostComments); $i++) {
            if (isset($mostComments[$i])) { ?>
                <div class="single-list flex-row d-flex">
                    <div class="thumb">
                        <img src="<?= asset($mostComments[$i]->image) ?>" alt="" width="130">
                    </div>
                    <div class="details">
                        <a href="image-post.html">
                            <h6><?= $mostComments[$i]->title ?></h6>
                        </a>
                        <ul class="meta">
                            <li><a href="#"><?= jaliliDate($mostComments[$i]->created_at) ?><span class="lnr lnr-calendar-full"></span></a></li>
                            <li><a href="#"><?= $mostComments[$i]->mostComment ?><span class="lnr lnr-bubble"></span></a></li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        <? } ?>
    </div>
</div>