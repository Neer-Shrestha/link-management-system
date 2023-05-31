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

<body class="bg-body-tertiary">

    <div id="page">
        <header class="site-header position-sticky bg-dark py-4">
            <div class="container">
                <div class="header-inner">
                    <a href="<?php echo get_root_directory_uri(); ?>/" class="site-brand">Linkme</a>

                    <nav class="main-navigation">
                        <ul class="menu">
                            <?php if (!is_login()) : ?>
                                <li><a href="<?php echo get_root_directory_uri(); ?>/login">Login</a></li>
                                <li><a href="<?php echo get_root_directory_uri(); ?>/register">Register</a></li>
                            <?php endif; ?>
                            <?php if (is_login()) : ?>
                                <li><a href="<?php echo get_root_directory_uri(); ?>/account">Account</a></li>
                                <li><a href="<?php echo get_root_directory_uri(); ?>/logout">Log out</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <main class="main-content">