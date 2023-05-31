<?php
function get_frontend_uri(): string
{
    return FRONTEND_PATH;
}
function get_root_directory_uri(): string
{
    return ABSPATH;
}
function get_header(): void
{
    include_once 'frontend/header.php';
}
function get_footer(): void
{
    include_once 'frontend/footer.php';
}
