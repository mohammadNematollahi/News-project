<?php require_once(DIR . "/template/admin/layout/header.php"); ?>

<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">Edit User</h1>
</section>

<section class="row my-3">
    <section class="col-12">

        <form method="post" action="<?= url("admin/user/update/") . "/" . $infoUser->id ?>">
            <div class="form-group">
                <label for="username">Firstname</label>
                <input type="text" class="form-control" id="username" name="first_name" placeholder="Enter title ..." value="<?= $infoUser->first_name; ?>">
            </div>
            <div class="form-group">
                <label for="userlastname">Lastname</label>
                <input type="text" class="form-control" id="username" name="last_name" placeholder="Enter title ..." value="<?= $infoUser->last_name; ?>">
            </div>

            <div class="form-group">
                <label for="permission">permission</label>
                <select name="permission" id="permission" class="form-control" required autofocus>
                    <option value="user" <?= $status = $infoUser->permission == "user" ? "selected" : "" ?>>User</option>
                    <option value="admin" <?= $status = $infoUser->permission == "admin" ? "selected" : "" ?>>Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">password</label>
                <input type="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">update</button>
        </form>

    </section>
</section>
</main>
</div>
</div>
<?php require_once(DIR . "/template/admin/layout/footer.php"); ?>