<?php
if (!is_admin()) :
    header("Location: " . get_root_directory_uri() . "/account");
endif;

get_header(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 ps-0">
            <?php include_once 'admin_sidebar.php'; ?>
        </div>
        <div class="col-md-9">
            <div class="row py-4">
                <div class="col-md-6">
                    <div class="p-4 lm-bg-tertiary">
                        <span class="fw-700 display-5">
                            <?php echo get_total_users(); ?>
                        </span>
                        <strong class="d-block">Total Users</strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 lm-bg-tertiary">
                        <span class="fw-700 display-5">
                            <?php echo get_total_link_count(); ?>
                        </span>
                        <strong class="d-block">Total Links</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>