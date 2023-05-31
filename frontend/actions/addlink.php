<?php
check_is_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['link_title'];
    $url = $_POST['link_url'];
    $userid = get_userid();

    post_user_link($title, $url, $userid);
    exit();
} else {
    header('Location: ' . GET_ROOT_DIRECTORY_URI() . '/account');
}
