<?php
define( 'PLUGINS_FOLDER' , __DIR__ . '/../wp-content/plugins');
define( 'THEMES_FOLDER' , __DIR__ . '/../wp-content/themes');

if( !file_exists(PLUGINS_FOLDER) ){
    die("PLUGINS FOLDER NOT FOUNT. THIS FOLDER SHOULD BE ON WORDPRESS ROOT FOLDER");
}

if( !file_exists(THEMES_FOLDER) ){
    die("THEMES FOLDER NOT FOUNT. THIS FOLDER SHOULD BE ON WORDPRESS ROOT FOLDER");
}

if( !file_exists(__DIR__ . '/../wp-config.php') ){
    die("wp-config.php file not found. THIS FOLDER SHOULD BE ON WORDPRESS ROOT FOLDER.");
}
require_once __DIR__ . '/../wp-config.php';
#require_once __DIR__ . '/myphp-backup.php';
require_once __DIR__ . '/myphp-restore.php';