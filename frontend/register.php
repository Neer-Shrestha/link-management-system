<?php get_header(); ?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['register_name'];
    $username = $_POST['register_username'];
    $email = $_POST['register_email'];
    $password = $_POST['register_password'];
    $confirm_password = $_POST['register_confirm_password'];
    $file_user_avatar = $_FILES['file_user_avatar'];
    $validate_msg = validate_user($name, $username, $email, $password, $confirm_password);

    if (count($validate_msg) == 0) :
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = password_hash($password, PASSWORD_DEFAULT); //Hash the password
        $confirm_password = password_hash($confirm_password, PASSWORD_DEFAULT); //Hash the password
        $msg = register_user($name, $file_user_avatar, $username, $email, $password, $confirm_password);
    endif;
}

?>


<section class="form-signin h-100 mt-auto py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">

                <?php if (isset($msg['success'])) : ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $msg['success']; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($msg['error'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $msg['error']; ?>
                    </div>
                <?php endif; ?>

                <div class="text-center">
                    <h1 class="h3 mb-3 fw-normal">Register</h1>
                </div>
                <form method="post" class="row gy-4" autocomplete="off" enctype="multipart/form-data">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="register_name" id="register_name" placeholder="name@example.com">
                            <label for="register_name">Name</label>
                            <?php if (isset($validate_msg['name'])) : ?>
                                <span class="text-danger"><?php echo $validate_msg['name']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="register_username" id="register_username" placeholder="name@example.com">
                            <label for="register_username">Username</label>
                            <?php if (isset($validate_msg['username'])) : ?>
                                <span class="text-danger"><?php echo $validate_msg['username']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" name="register_email" id="register_email" placeholder="name@example.com">
                            <label for="register_email">Email address</label>
                            <?php if (isset($validate_msg['email'])) : ?>
                                <span class="text-danger"><?php echo $validate_msg['email']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="register_password" id="register_password" placeholder="Password">
                            <label for="register_password">Password</label>
                            <?php if (isset($validate_msg['password'])) : ?>
                                <span class="text-danger"><?php echo $validate_msg['password']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="register_confirm_password" id="register_confirm_password" placeholder="Password">
                            <label for="register_confirm_password">Confirm Password</label>
                            <?php if (isset($validate_msg['password'])) : ?>
                                <span class="text-danger"><?php echo $validate_msg['password']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="file" name="file_user_avatar" id="file_user_avatar" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
