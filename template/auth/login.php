<?php require_once(DIR . "/template/auth/layout/header.php"); ?>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="<?= asset("/asset/auth/assets/images/img-01.png") ?>" alt="IMG">
                </div>

                <form method="post" action="<?= url("auth/check-login") ?>" class="login100-form validate-form">
                    <span class="login100-form-title">
                        Member Login
                    </span>

                    <?php
                    $e = flash("check_login");
                    if ($e) { ?>
                        <div class="mb-2 alert alert-danger">
                            <small class="form-text text-danger">
                                <?= $e ?>
                            </small>
                        </div>
                    <? }
                    ?>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="<?= url("auth/forgot") ?>">
                            Username / Password?
                        </a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="#">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once(DIR . "/template/auth/layout/footer.php"); ?>