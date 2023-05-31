<?php

if (!isset($_GET['id'])) {
    header('Location: ' . get_root_directory_uri() . '/404');
    exit();
}
$user_id = $_GET['id'];
$links = get_user_links($user_id);
$user_data = get_user_data($user_id);

get_header();

?>

<?php if ($user_data) :

    $avatar = $user_data['user_avatar'];
    $name = $user_data['user_name'];
?>
    <section class="py-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-5">
                    <div class="user-info">
                        <?php if (!empty($avatar)) : ?>
                            <figure class="user-avatar">
                                <img src="<?php echo get_uploaded_img_uri($avatar); ?>" alt="<?php echo !empty($name) ? $name : 'user avatar'; ?>">
                            </figure>
                        <?php endif; ?>
                        <?php if (!empty($name)) : ?>
                            <h1 class="h4"><?php echo $name; ?></h1>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <?php if ($links) : ?>
                        <h2 class="h4 mb-4">Usefull links</h2>
                        <ul class="links-list">
                            <?php foreach ($links as $row) : ?>
                                <li><a href="<?php echo $row['link_content']; ?>" class="btn btn-primary d-block" target="_blank"><?php echo $row['link_title']; ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="h3">Looks Like the user you are searching is not found.</h1>
                    <a href="<?php echo get_root_directory_uri(); ?>/" class="btn btn-primary">Go To Home</a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
get_footer();
