<?php
if (!is_admin()) :
    header("Location: " . get_root_directory_uri() . "/account");
endif;

get_header();

$users = get_all_users_data();

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 ps-0">
            <?php include_once 'admin_sidebar.php'; ?>
        </div>
        <div class="col-md-9">
            <div class="row py-4">
                <div class="col-md-12">
                    <div class="p-4 lm-bg-tertiary">
                        <?php if ($users) : ?>

                            <h1 class="h4 mb-4">User List</h1>

                            <ul class="user-list">
                                <?php foreach ($users as $user) : ?>
                                    <li class="d-flex align-items-center mb-3">
                                        <a href="<?php echo get_root_directory_uri(); ?>/user?id=<?php echo urlencode($user['user_id']); ?>" target="_blank" aria-label="user link">
                                            <figure class="user-avatar me-3 mb-0">
                                                <img src="<?php echo get_uploaded_img_uri($user['user_avatar']); ?>" alt="<?php echo $user['user_name']; ?>">
                                            </figure>
                                        </a>

                                        <div class="user_info">
                                            <a href="<?php echo get_root_directory_uri(); ?>/user?id=<?php echo urlencode($user['user_id']); ?>" target="_blank" aria-label="user link">
                                                <strong><?php echo $user['user_name']; ?></strong>
                                            </a>

                                            <?php $formattedDate = get_formated_date($user['user_registerd']); ?>

                                            <span class="d-block">Registered Date: <?php echo $formattedDate; ?></span>
                                        </div>
                                    </li>

                                <?php endforeach; ?>
                            </ul>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>