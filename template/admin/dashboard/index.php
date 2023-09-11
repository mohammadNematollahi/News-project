<?php require_once(DIR . "/template/admin/layout/header.php") ?>
<div class=" row mt-3">

    <div class=" col-sm-6 col-lg-3">
        <a href="" class=" text-decoration-none">
            <div class=" card text-white bg-gradiant-green-blue mb-3">
                <div class=" card-header d-flex justify-content-between align-items-center"><span><i class=" fas fa-clipboard-list"></i> Categories</span><?= $countCategories[0]->existCat ?> <span class=" badge badge-pill right"></span></div>
                <div class=" card-body">
                    <section class=" font-12 my-0"><i class=" fas fa-clipboard-list"></i> GO TO Categories!</section>
                </div>
            </div>
        </a>
    </div>
    <div class=" col-sm-6 col-lg-3">
        <a href="" class=" text-decoration-none">
            <div class=" card text-white bg-juicy-orange mb-3">
                <div class=" card-header d-flex justify-content-between align-items-center"><span><i class=" fas fa-users"></i> Users</span> <span class=" badge badge-pill right"><?= $countNormalusers[0]->normalUser ?></span></div>
                <div class=" card-body">
                    <section class=" d-flex justify-content-between align-items-center font-12">
                        <span class=""><i class=" fas fa-users-cog"></i> Admin <span class=" badge badge-pill mx-1"><?= $countAdminusers[0]->adminUser ?></span></span>
                        <span class=""><i class=" fas fa-user"></i> All Users <span class=" badge badge-pill mx-1"><?= $countUsers[0]->existUser ?></span></span>
                    </section>
                </div>
            </div>
        </a>
    </div>
    <div class=" col-sm-6 col-lg-3">
        <a href="" class=" text-decoration-none">
            <div class=" card text-white bg-dracula mb-3">
                <div class=" card-header d-flex justify-content-between align-items-center"><span><i class=" fas fa-newspaper"></i> Article</span> <span class=" badge badge-pill right"><?= $countPosts[0]->post ?></span></div>
                <div class=" card-body">
                    <section class=" d-flex justify-content-between align-items-center font-12">
                        <span class=""><i class=" fas fa-bolt"></i> Views <span class=" badge badge-pill mx-1"><?= $sumViewPosts[0]->view == null ? "0" : $sumViewPosts[0]->view ?></span></span>
                    </section>
                </div>
            </div>
        </a>
    </div>
    <div class=" col-sm-6 col-lg-3">
        <a href="" class=" text-decoration-none">
            <div class=" card text-white bg-neon-life mb-3">
                <div class=" card-header d-flex justify-content-between align-items-center"><span><i class=" fas fa-comments"></i> Comment</span> <span class=" badge badge-pill right"><?= $countComments[0]->existComment ?></span></div>
                <div class=" card-body">
                    <!--                        <h5 class=" card-title">Info card title</h5>-->
                    <section class=" d-flex justify-content-between align-items-center font-12">
                        <span class=""><i class=" far fa-eye-slash"></i> Unseen <span class=" badge badge-pill mx-1"><?= $commentsUnseen[0]->exsitUnseen ?></span></span>
                        <span class=""><i class=" far fa-check-circle"></i> Approved <span class=" badge badge-pill mx-1"><?= $commentsApproved[0]->existApproved ?></span></span>
                    </section>
                </div>
            </div>
        </a>
    </div>

</div>


<div class=" row mt-2">
    <div class=" col-4">
        <h2 class=" h6 pb-0 mb-0">
            Most viewed posts
        </h2>
        <div class=" table-responsive">
            <table class=" table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>title</th>
                        <th>view</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($mostViewPosts as $post) { ?>
                        <tr>
                            <td>
                                <a class=" text-primary" href="">
                                    <?= $post->id ?>
                                </a>
                            </td>
                            <td>
                                <?= $post->title ?>
                            </td>
                            <td><span class=" badge badge-secondary"><?= $post->view ?></span></td>
                        </tr>
                    <? }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class=" col-4">
        <h2 class=" h6 pb-0 mb-0">
            Most commented posts

        </h2>
        <div class=" table-responsive">
            <table class=" table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>title</th>
                        <th>comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($mostCommentoPosts as $mostComment) { ?>
                        <tr>
                            <td>
                                <a class=" text-primary" href="">
                                    <?= $mostComment->maxP ?>
                                </a>
                            </td>
                            <td>
                                <?= $mostComment->title ?>
                            </td>
                            <td><span class=" badge badge-success"><?= $mostComment->countP ?></span></td>
                        </tr>
                    <? }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class=" col-4">
        <h2 class=" h6 pb-0 mb-0">
            Comments
        </h2>
        <div class=" table-responsive">
            <table class=" table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>username</th>
                        <th>comment</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>


                    <tr>
                        <td>
                            <a class=" text-primary" href="">
                                ss
                            </a>
                        </td>
                        <td>
                            ss
                        </td>
                        <td>
                            ss
                        </td>
                        <td><span class=" badge badge-warning">ss</span></td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>


</main>
</div>
</div>
<?php require_once(DIR . "/template/admin/layout/footer.php") ?>