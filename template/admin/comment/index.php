<?php require_once(DIR . "/template/admin/layout/header.php"); ?>
<div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class=" h5"><i class=" fas fa-newspaper"></i> Comments</h1>
    <div class=" btn-toolbar mb-2 mb-md-0">
        <a role=" button" href=" #" class=" btn btn-sm btn-success disabled">create</a>
    </div>
</div>
<section class=" table-responsive">
    <table class=" table table-striped table-sm">
        <caption>List of comments</caption>
        <thead>
            <tr>
                <th>#</th>
                <th>User name</th>
                <th>Post title</th>
                <th>comment</th>
                <th>status</th>
                <th>setting</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($comments as $comment) { ?>
                <tr>
                    <td><a href=""><?= $comment->id ?></a>
                    </td>
                    <td>
                        <?= $comment->first_name . " " . $comment->last_name ?>
                    </td>
                    <td>
                        <?= $comment->title ?>
                    </td>
                    <td>

                        <?= $comment->comment ?>
                    </td>
                    <td>
                        <?= $comment->status ?>
                    </td>
                    <td>
                        <a role=" button" class=" btn btn-sm btn-success text-white" href="<?= url("admin/comment/change-status/" . $comment->id) ?>">
                            <?= $status = $comment->status == "seen"? "click to approved" : "click not to approved" ?>
                        </a>
                    </td>
                </tr>
            <? }
            ?>
        </tbody>
    </table>
</section>
</main>
</div>
</div>
<?php require_once(DIR . "/template/admin/layout/footer.php"); ?>