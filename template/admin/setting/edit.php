<?php require_once(DIR . "/template/admin/layout/header.php") ?>
<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">Set Web Setting</h1>
</section>

<section class="row my-3">
    <section class="col-12">

        <form method="post" action="<?= url("admin/setting/set-websetting") ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title ..." value="<?= isset($result[0]->id) ? $result[0]->title : ""; ?>" autofocus>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Enter title ..." value="<?= isset($result[0]->id) ? $result[0]->description : ""; ?>" autofocus>
            </div>

            <div class="form-group">
                <label for="keywords">Keywords</label>
                <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Enter title ..." value="<?= isset($result[0]->id) ? $result[0]->keywords : ""; ?>" autofocus>
            </div>


            <div class="form-group">

                <img style="width: 100px;" src="<?= url($result[0]->logo) ?>" alt="">
                <hr />

                <label for="logo">Logo</label>
                <input type="file" id="logo" name="logo" class="form-control-file" autofocus>
            </div>

            <div class="form-group">

                <img style="width: 100px;" src="<?= url($result[0]->icon) ?>" alt="">
                <hr />

                <label for="icon">Icon</label>
                <input type="file" id="icon" name="icon" class="form-control-file" autofocus>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">set</button>
        </form>
    </section>
</section>
</main>
</div>
</div>
<?php require_once(DIR . "/template/admin/layout/footer.php") ?>