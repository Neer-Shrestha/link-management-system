<?php
check_is_login();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['file_user_avatar'])) {
        $file = $_FILES['file_user_avatar'];
        $userid = get_userid();

        handle_file_upload($file, $userid);
        header('Location: ' . get_root_directory_uri() . '/account');
        exit();
    }
}
