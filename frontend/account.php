<?php
check_is_login();
get_header();

$user_id = $_SESSION['user_id'];
$links = get_user_links($user_id);
$user_data = get_user_data($user_id);
?>

<section class="py-5">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-5">
                <?php if ($user_data) :

                    $avatar = $user_data['user_avatar'];
                    $name = $user_data['user_name'];
                ?>
                    <div class="user-info position-relative">
                        <button class="btn btn-primary position-absolute start-0 p-1 top-0" type="button" data-bs-toggle="collapse" data-bs-target="#upload_form_collapse" aria-expanded="false" aria-controls="upload_form_collapse" aria-label="edit">
                            <svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5,18H9.24a1,1,0,0,0,.71-.29l6.92-6.93h0L19.71,8a1,1,0,0,0,0-1.42L15.47,2.29a1,1,0,0,0-1.42,0L11.23,5.12h0L4.29,12.05a1,1,0,0,0-.29.71V17A1,1,0,0,0,5,18ZM14.76,4.41l2.83,2.83L16.17,8.66,13.34,5.83ZM6,13.17l5.93-5.93,2.83,2.83L8.83,16H6ZM21,20H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z" fill="#fff" />
                            </svg>
                        </button>
                        <?php if (!empty($avatar)) : ?>
                            <figure class="user-avatar">
                                <img src="<?php echo get_uploaded_img_uri($avatar); ?>" alt="<?php echo !empty($name) ? $name : 'user avatar'; ?>">
                            </figure>
                        <?php endif; ?>
                        <?php if (!empty($name)) : ?>
                            <h1 class="h4"><?php echo $name; ?></h1>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>
                <div class="collapse" id="upload_form_collapse">
                    <div class="pt-3">
                        <form method="post" action="<?php echo get_root_directory_uri(); ?>/upload-image" enctype="multipart/form-data">
                            <input type="file" name="file_user_avatar" id="file_user_avatar" class="form-control">
                            <button class="mt-4 btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="mt-5"></div>
                <h2 class="h4">Share :</h2>
                <div class="highlight border-1 bg-dark p-3 rounded-2 border-primary">
                    <p><?php echo $_SERVER['HTTP_HOST'] . get_root_directory_uri(); ?>/user?id=<?php echo urlencode($user_id); ?></p>
                </div>

            </div>
            <div class="col-md-6">
                <h2 class="h4 mb-4">Add links</h2>
                <form method="post" action="<?php echo get_root_directory_uri(); ?>/addlink" class="row gy-4" autocomplete="off">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="link_title" id="link_title" placeholder="Eg. Linkme" required>
                            <label for="link_title">Title</label>
                            <?php if (isset($msg['username'])) : ?>
                                <span class="text-danger">
                                    <?php echo $msg['username']; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="form-floating">
                            <input type="url" class="form-control" name="link_url" id="link_url" placeholder="Password" required>
                            <label for="link_url">Url</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Add Link</button>
                    </div>
                </form>

                <?php if ($links) : ?>
                    <h2 class="mt-5 h4 mb-4">My links</h2>
                    <ul class="links-list">
                        <?php foreach ($links as $row) : ?>
                            <li class="d-flex align-items-center">
                                <a href="<?php echo $row['link_content']; ?>" class="btn flex-grow-1 btn-primary me-2" target="_blank"><?php echo $row['link_title']; ?></a>
                                <a class="btn btn-primary p-2" href="<?php echo ABSPATH; ?>/delete?id=<?php echo urlencode($row['link_id']); ?>" aria-label="delete">
                                    <svg width="20" height="20" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4V14H12v24zM38 8h-7l-2-2H19l-2 2h-7v4h28V8z" fill="var(--bs-danger)" />
                                        <path d="M0 0h48v48H0z" fill="none" />
                                    </svg>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
