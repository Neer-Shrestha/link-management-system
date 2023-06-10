<?php

//Check Routes
$routes = [
    get_root_directory_uri() . '/' =>  'frontend/index.php',
    get_root_directory_uri() . '/admin' =>  'frontend/admin/admin.php',
    get_root_directory_uri() . '/users' =>  'frontend/admin/users.php',
    get_root_directory_uri() . '/login' =>  'frontend/login.php',
    get_root_directory_uri() . '/register' =>  'frontend/register.php',
    get_root_directory_uri() . '/account' =>  'frontend/account.php',
    get_root_directory_uri() . '/user' =>  'frontend/user.php',
    get_root_directory_uri() . '/404' =>  'frontend/404.php',
    get_root_directory_uri() . '/logout' =>  'frontend/actions/logout.php',
    get_root_directory_uri() . '/addlink' =>  'frontend/actions/addlink.php',
    get_root_directory_uri() . '/upload-image' =>  'frontend/actions/update_user_avatar.php',
    get_root_directory_uri() . '/delete' =>  'frontend/actions/delete_link.php',
];

// Get the URL path from the request
$path = parse_url($_SERVER['REQUEST_URI'])['path'];

$current_route = explode(get_root_directory_uri() . '/', $path);

if (array_key_exists($path, $routes)) {
    require $routes[$path];
} else {
    require 'frontend/404.php';
}
