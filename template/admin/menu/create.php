<?php require_once(DIR . "/template/admin/layout/header.php") ?>

<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">Create Menu</h1>
</section>

<section class="row my-3">
    <section class="col-12">
        <form method="post" action="<?= url("admin/menu/store") ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name ..." required>
            </div>

            <div class="form-group">
                <label for="url">url</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="Enter url ..." required>
            </div>

            <div class="form-group">
                <label for="parent_id">parent ID</label>
                <select name="parent_id" id="parent_id" class="form-control" autofocus>
                    <option value="">root</option>
                    <?php
                    foreach ($subMenus as $subMenu) { ?>
                        <option value="<?= $subMenu->id ?>">
                            <?= $subMenu->name ?>
                        </option>
                    <? }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">store</button>
        </form>
    </section>
</section>

</main>
</div>
</div>
</main>
</div>
</div>
<?php require_once(DIR . "/template/admin/layout/footer.php") ?>