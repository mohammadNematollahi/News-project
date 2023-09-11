<?php require_once(DIR . "/template/admin/layout/header.php"); ?>
<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">Edit Banner</h1>
</section>
<section class="row my-3">
    <section class="col-12">

        <form method="post" action="<?= url("admin/baner/update/" . $showBaner->id) ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="Enter url ..." value="<?= $showBaner->url ?>">
            </div>

            <div class="form-group">
                <img style="width: 100px;" src="" alt="">
                <hr />
                <label for="image">Image</label>
                <input type="file" id="image" name="img" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary btn-sm">update</button>
        </form>
    </section>
</section>



</main>
</div>
</div>

<?php require_once(DIR . "/template/admin/layout/footer.php"); ?>