<?php
get_header();
?>

<section class="error py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="mb-4">404 Error!</h1>
                <h2 class="mb-3">The page you are looking for is not found.</h2>
                <a class="btn btn-primary" href="<?php echo get_root_directory_uri(); ?>/">Go To Home</a>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
