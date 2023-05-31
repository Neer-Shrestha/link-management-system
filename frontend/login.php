<?php get_header(); ?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    $msg = user_auth($username, $password);
}

?>


<section class="form-signin h-100 mt-auto py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">

                <div class="text-center">
                    <h1 class="h3 mb-3 fw-normal">Login</h1>
                </div>
                <?php if (isset($msg['error'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $msg['error']; ?>
                    </div>
                <?php endif; ?>
                <form method="post" class="row gy-4" autocomplete="off">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="login_username" id="login_username" placeholder="name@example.com">
                            <label for="login_username">Username</label>
                            <?php if (isset($msg['username'])) : ?>
                                <span class="text-danger">
                                    <?php echo $msg['username']; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="login_password" id="login_password" placeholder="Password">
                            <label for="login_password">Password</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
