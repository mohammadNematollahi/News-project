<?php require_once(DIR . "/template/admin/layout/header.php"); ?>
<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">Edit Article</h1>
</section>
<section class="row my-3">
    <section class="col-12">

        <form method="post" action="<?= url("admin/post/update/" . $showPost->id) ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title ..." value="<?= $showPost->title ?>">
            </div>

            <div class="form-group">
                <label for="cat_id">Category</label>
                <select name="id_cat" id="cat_id" class="form-control" required autofocus>

                    <?php
                    foreach ($selectCategories as $selectCategory) { ?>
                        <option value="<?= $selectCategory->id ?>" <?= $showPost->cat_name == $selectCategory->name ? "selected" : "" ?>>
                            <?= $selectCategory->name ?>
                        </option><? } ?>
                </select>
            </div>

            <div class="form-group">
                <img style="width: 100px;" src="<?= url($showPost->image) ?>" alt="">
                <hr />
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control-file" autofocus>
            </div>

            <div class="form-group">
                <label for="published_at">published at</label>
                <input type="text" class="form-control d-none" id="published_at" name="published_at" required autofocus value="">
                <input type="text" class="form-control" id="published_at_view" value="<?= $showPost->published_at ?>" required autofocus>
            </div>

            <div class="form-group">
                <label for="summary">summary</label>
                <textarea class="form-control" id="summary" name="summary" placeholder="summary ..." rows="3">
                <?= $showPost->summary; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="body">body</label>
                <textarea class="form-control" id="body" name="body" placeholder="body ..." rows="5">
                <?= $showPost->body; ?>
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">update</button>
        </form>
    </section>
</section>



</main>
</div>
</div>
<?php require_once(DIR . "/template/admin/layout/footer.php"); ?>