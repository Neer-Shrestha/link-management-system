<?php
get_header(); ?>

<div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="<?php echo FRONTEND_PATH; ?>/assets/img/illustration.png" class="d-block mx-lg-auto img-fluid" alt="banner image" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Share your links with your friends.</h1>
            <p class="lead">With our link sharing platform you can make your own account and add your social links to other user.</p>
            <div class="mt-4">
                <a href="<?php echo get_root_directory_uri(); ?>/register" class="btn btn-primary btn-lg px-4 me-md-2">Get Started</a>
            </div>
        </div>
    </div>
</div>



<?php
get_footer();
