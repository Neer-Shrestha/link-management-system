<?php
check_is_login();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) :
        $linkid = $_GET['id'];
        delete_link($linkid);
    endif;
    header('Location: ' . get_root_directory_uri() . '/account');
    exit();
} else {
    header('Location: ' . get_root_directory_uri() . '/account');
    exit();
}
