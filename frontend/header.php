<?php global $current_route; ?>



<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A system which helps user to share their social liks or profile to other peope through this website.">
    <meta name="keywords" content="link, link management system, management system">
    <title>Link Management System</title>
    <link rel="stylesheet" href="<?php echo get_frontend_uri(); ?>/assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo get_frontend_uri(); ?>/assets/css/style.css">

</head>


<body class="<?php echo $current_route[1]; ?>">

    <div id="page">
        <header class="site-header navbar-expand-md py-4">
            <div class="container">
                <div class="header-inner">
                    <a href="<?php echo get_root_directory_uri(); ?>/" class="site-brand">Linkme</a>

                    <button class="btn btn-primary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mainHeaderOffcanvas" aria-controls="mainHeaderOffcanvas">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="mainHeaderOffcanvas" aria-labelledby="mainHeaderOffcanvasLabel">
                        <div class="offcanvas-header p-4">
                            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Linkme</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body justify-content-end p-4 p-md-0">
                            <nav class="main-navigation">
                                <ul class="menu">
                                    <?php if (!is_login()) : ?>
                                        <li><a href="<?php echo get_root_directory_uri(); ?>/login">Login</a></li>
                                        <li><a href="<?php echo get_root_directory_uri(); ?>/register">Register</a></li>
                                    <?php endif; ?>
                                    <?php
                                    if (is_admin()) : ?>
                                        <li><a href="<?php echo get_root_directory_uri(); ?>/admin">Dashboard</a></li>
                                    <?php endif; ?>
                                    <?php if (is_login()) : ?>
                                        <li><a href="<?php echo get_root_directory_uri(); ?>/account">Account</a></li>
                                        <li><a href="<?php echo get_root_directory_uri(); ?>/logout">Log out</a></li>
                                    <?php endif; ?>
                                </ul>
                                <?php if (is_login()) : ?>


                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Add Link
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Link</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                <?php endif; ?>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <main class="main-content">