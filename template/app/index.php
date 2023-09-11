<?php require_once(DIR . "/template/app/layout/header.php") ?>
<div class="site-main-container">
    <!-- Start top-post Area -->
    <section class="top-post-area pt-10">
        <div class="container no-padding">
            <div class="row small-gutters">
                <?php if (isset($newsSelected[0])) { ?>
                    <div class="col-lg-8 top-post-left">
                        <div class="feature-image-thumb relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid" src="<?= asset($newsSelected[0]->image) ?>" alt="">
                        </div>
                        <div class="top-post-details">
                            <ul class="tags">
                                <li><a href="#"><?= $newsSelected[0]->nameCat ?></a></li>
                            </ul>
                            <a href="<?= url("internal-page" . "/" . $newsSelected[0]->id) ?>">
                                <h3><?= $newsSelected[0]->title ?></h3>
                            </a>
                            <ul class="meta">
                                <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                                <li><a href="#"><?= jaliliDate($newsSelected[0]->created_at) ?><span class="lnr lnr-calendar-full"></span></a></li>
                                <li><a href="#"><?= $newsSelected[0]->countComments ?><span class="lnr lnr-bubble"></span></a></li>
                            </ul>
                        </div>
                    </div>
                <? } ?>
                <div class="col-lg-4 top-post-right">
                    <?php if (isset($newsSelected[1])) { ?>
                        <div class="single-top-post">
                            <div class="feature-image-thumb relative">
                                <div class="overlay overlay-bg"></div>
                                <img class="img-fluid" src="<?= asset($newsSelected[1]->image) ?>" alt="">
                            </div>
                            <div class="top-post-details">
                                <ul class="tags">
                                    <li><a href="#"><?= $newsSelected[1]->nameCat ?></a></li>
                                </ul>
                                <a href="<?= url("internal-page" . "/" . $newsSelected[1]->id) ?>">
                                    <h4><?= $newsSelected[1]->title ?></h4>
                                </a>
                                <ul class="meta">
                                    <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                                    <li><a href="#"><?= jaliliDate($newsSelected[1]->created_at) ?><span class="lnr lnr-calendar-full"></span></a></li>
                                    <li><a href="#"> <?= $newsSelected[1]->countComments ?><span class="lnr lnr-bubble"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    <? } else if (isset($newsSelected[2])) { ?>
                        <div class="single-top-post mt-10">
                            <div class="feature-image-thumb relative">
                                <div class="overlay overlay-bg"></div>
                                <img class="img-fluid" src="<?= asset($newsSelected[2]->image) ?>" alt="">
                            </div>
                            <div class="top-post-details">
                                <ul class="tags">
                                    <li><a href="#"><?= $newsSelected[2]->nameCat ?></a></li>
                                </ul>
                                <a href="<?= url("internal-page" . "/" . $newsSelected[2]->id) ?>">
                                    <h4><?= $newsSelected[2]->title ?></h4>
                                </a>
                                <ul class="meta">
                                    <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                                    <li><a href="#"><?= jaliliDate($newsSelected[2]->created_at) ?><span class="lnr lnr-calendar-full"></span></a></li>
                                    <li><a href="#"><?= $newsSelected[2]->countComments ?><span class="lnr lnr-bubble"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    <? } ?>
                </div>
                <div class="col-lg-12">
                    <div class="news-tracker-wrap">
                        <h6><span>خبر فوری:</span> <a href="#"><?= $brekingNews[0]->title ?></a></h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End top-post Area -->
    <!-- Start latest-post Area -->
    <section class="latest-post-area pb-120">
        <div class="container no-padding">
            <div class="row">
                <div class="col-lg-8 post-list">
                    <!-- Start latest-post Area -->
                    <div class="latest-post-wrap">
                        <h4 class="cat-title">آخرین اخبار</h4>
                        <?php
                        for ($i = 0; $i < count($lastNews); $i++) {
                            if (!empty($lastNews[$i])) { ?>

                                <div class="single-latest-post row align-items-center">
                                    <div class="col-lg-5 post-left">
                                        <div class="feature-img relative">
                                            <div class="overlay overlay-bg"></div>
                                            <img class="img-fluid" src="<?= asset($lastNews[$i]->image) ?>" alt="">
                                        </div>
                                        <ul class="tags">
                                            <li><a href="#"><?= $lastNews[$i]->nameCat ?></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-7 post-right">
                                        <a href="<?= url("internal-page" . "/" . $lastNews[$i]->id) ?>">
                                            <h4><?= $lastNews[$i]->title ?></h4>
                                        </a>
                                        <ul class="meta">
                                            <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                                            <li><a href="#"><?= jaliliDate($lastNews[$i]->created_at) ?><span class="lnr lnr-calendar-full"></span></a></li>
                                            <li><a href="#"> <?= $lastNews[$i]->countComments ?><span class="lnr lnr-bubble"></span></a></li>
                                        </ul>
                                        <p class="excert">
                                            <?= $lastNews[$i]->summary ?>
                                        </p>
                                    </div>
                                </div>
                            <?
                            } ?>
                        <? } ?>
                    </div>
                    <?php
                    if (isset($baners)) { ?>
                        <div class="col-lg-12 ad-widget-wrap mt-30 mb-30">
                            <img class="img-fluid" src="<?= asset($baners[0]->img) ?>" alt="">
                        </div>
                    <? }
                    ?>
                    <div class="popular-post-wrap">
                        <h4 class="title">اخبار پربازدید</h4>
                        <?php
                        if (isset($mostViewPost[0])) { ?>
                            <div class="feature-post relative">
                                <div class="feature-img relative">
                                    <div class="overlay overlay-bg"></div>
                                    <img class="img-fluid" src="<?= asset($mostViewPost[0]->image) ?>" alt="">
                                </div>
                                <div class="details">
                                    <ul class="tags">
                                        <li><a href="#"><?= $mostViewPost[0]->nameCat ?></a></li>
                                    </ul>
                                    <a href="<?= url("internal-page" . "/" . $mostViewPost[0]->id) ?>">
                                        <h3><?= $mostViewPost[0]->title ?></h3>
                                    </a>
                                    <ul class="meta">
                                        <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                                        <li><a href="#"><?= jaliliDate($mostViewPost[0]->created_at) ?><span class="lnr lnr-calendar-full"></span></a></li>
                                        <li><a href="#"><?= $mostViewPost[0]->countComments ?><span class="lnr lnr-bubble"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        <? } ?>
                        <div class="row mt-20 medium-gutters">
                            <?php
                            if (isset($mostViewPost[1])) { ?>
                                <div class="col-lg-6 single-popular-post">
                                    <div class="feature-img-wrap relative">
                                        <div class="feature-img relative">
                                            <div class="overlay overlay-bg"></div>
                                            <img class="img-fluid" src="<?= asset($mostViewPost[1]->image) ?>" alt="">
                                        </div>
                                        <ul class="tags">
                                            <li><a href="#"><?= $mostViewPost[1]->nameCat ?></a></li>
                                        </ul>
                                    </div>
                                    <div class="details">
                                        <a href="<?= url("internal-page" . "/" . $mostViewPost[1]->id) ?>">
                                            <h4><?= $mostViewPost[1]->title ?></h4>
                                        </a>
                                        <ul class="meta">
                                            <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                                            <li><a href="#"><?= jaliliDate($mostViewPost[1]->created_at) ?><span class="lnr lnr-calendar-full"></span></a></li>
                                            <li><a href="#"> <?= $mostViewPost[1]->countComments ?><span class="lnr lnr-bubble"></span></a></li>
                                        </ul>
                                        <p class="excert">
                                            <?= $mostViewPost[1]->summary ?>
                                        </p>
                                    </div>
                                </div><? } ?>
                            <?php
                            if (isset($mostViewPost[2])) { ?>
                                <div class="col-lg-6 single-popular-post">
                                    <div class="feature-img-wrap relative">
                                        <div class="feature-img relative">
                                            <div class="overlay overlay-bg"></div>
                                            <img class="img-fluid" src="<?= asset($mostViewPost[2]->image) ?>" alt="">
                                        </div>
                                        <ul class="tags">
                                            <li><a href="#"><?= $mostViewPost[2]->nameCat ?></a></li>
                                        </ul>
                                    </div>
                                    <div class="details">
                                        <a href="<?= url("internal-page" . "/" . $mostViewPost[2]->id) ?>">
                                            <h4><?= $mostViewPost[2]->title ?></h4>
                                        </a>
                                        <ul class="meta">
                                            <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                                            <li><a href="#"><?= jaliliDate($mostViewPost[2]->created_at) ?><span class="lnr lnr-calendar-full"></span></a></li>
                                            <li><a href="#"> <?= $mostViewPost[2]->countComments ?><span class="lnr lnr-bubble"></span></a></li>
                                        </ul>
                                        <p class="excert">
                                            <?= $mostViewPost[2]->summary ?>
                                        </p>
                                    </div>
                                </div><? } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php require_once(DIR . "/template/app/layout/sidebar.php") ?>
                </div>
                <!-- End popular-post Area -->
            </div>
        </div>
</div>
</section>
<!-- End latest-post Area -->
</div>
<?php require_once(DIR . "/template/app/layout/footer.php") ?>
</body>

</html>