<?php require_once(DIR . "/template/app/layout/header.php") ?>
<div class="site-main-container">
    <!-- Start top-post Area -->
    <!-- End top-post Area -->
    <!-- Start latest-post Area -->
    <section class="latest-post-area pb-120">
        <div class="container no-padding">
            <div class="row">
                <div class="col-lg-8 post-list">
                    <!-- Start single-post Area -->
                    <div class="single-post-wrap">
                        <div class="feature-img-thumb relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid" src="<?= asset($fullInfoPost->image) ?>" alt="">
                        </div>
                        <div class="content-wrap">
                            <ul class="tags mt-10">
                                <li><a href="#"><?= $fullInfoPost->nameCat ?></a></li>
                            </ul>
                            <a href="#">
                                <h3><?= $fullInfoPost->title ?></h3>
                            </a>
                            <ul class="meta pb-20">
                                <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                                <li><a href="#"><?= jaliliDate($fullInfoPost->created_at) ?><span class="lnr lnr-calendar-full"></span></a></li>
                                <li><a href="#"><?= $fullInfoPost->countComments ?><span class="lnr lnr-bubble"></span></a></li>
                            </ul>
                            <?= $fullInfoPost->body ?>
                            <div class="navigation-wrap justify-content-between d-flex">
                                <a class="prev" href="#"><span class="lnr lnr-arrow-right"></span>خبر بعدی</a>
                                <a class="next" href="#">خبر قبلی<span class="lnr lnr-arrow-left"></span></a>
                            </div>

                            <div class="comment-sec-area">
                                <div class="container">
                                    <div class="row flex-column">
                                        <h6>نظرات</h6>
                                        <?php
                                        foreach ($showComments as $comment) {
                                        ?>
                                            <div class="comment-list">
                                                <div class="single-comment justify-content-between d-flex">
                                                    <div class="user justify-content-between d-flex">
                                                        <div class="desc">
                                                            <h5><a href="#"><?= $comment->first_name . " " . $comment->last_name ?></a></h5>
                                                            <p class="date mt-3"><?= jaliliDate($comment->created_at) ?></p>
                                                            <p class="comment">
                                                                <?= $comment->comment ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <? }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        // if (!isset($_SESSION["login"])) { 
                        ?>
                        <!-- //     <p>برای ثبت نطر باید ثبت نام کرده باشید</p> -->
                        <!-- // <?  ?> -->
                        <div class="comment-form">
                            <h4>درج نظر جدید</h4>
                            <form method="post" action="<?= url("send-comment") . "/" . $comment->post_id ?>">
                                <div class="form-group">
                                    <textarea class="form-control mb-10" rows="5" name="comment" placeholder="متن نظر" onfocus="this.placeholder = ''" onblur="this.placeholder = 'متن نظر'" required=""></textarea>
                                </div>
                                <button type="submit" class="primary-btn text-uppercase">ارسال</button>
                            </form>
                        </div>
                        <!-- <?
                                ?> -->
                    </div>
                    <!-- End single-post Area -->
                </div>
                <div class="col-lg-4">
                    <?php require_once(DIR . "/template/app/layout/sidebar.php") ?>
                </div>
            </div>
        </div>
    </section>
    <!-- End latest-post Area -->
</div>

<!-- start footer Area -->
<?php require_once(DIR . "/template/app/layout/footer.php") ?>