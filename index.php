<?php

// All constants
define('FRONTEND_PATH',  '/' . basename(__DIR__) . '/' . 'frontend');
define('ABSPATH',  '/' . basename(__DIR__));

// required files
require_once './functions.php';
require_once './backend/index.php';

// open database connection
$con = open_con();
session_start();

require_once './routes.php';

// close database connection
close_con($con);
