<?php

/**
 * Define some constants to get up and going
 */
define('API_START', microtime(true));
define('BASE', dirname(__DIR__));
date_default_timezone_set('UTC');


/**
 * Detect the application environment (need to switch to [] )
 */
if (file_exists(BASE . '/.env')) {
	Dotenv::load(BASE);
}
Dotenv::required([
    'API_ENV',
    'API_DEBUG',
    'API_MAINT',
    'DB_HOST',
    'DB_NAME',
    'DB_USER',
    'DB_PASS'
]);


/**
 * Toggle error reporting
 */
ini_set('display_errors', $_SERVER['API_DEBUG']);
error_reporting(E_ALL);


/**
 * Turn on maintenance mode by setting API_MAINT to true
 */
if ($_SERVER['API_MAINT']) {
	echo '&#9760; Down for a quick maintenance. Check back shortly. &#9760;';
    die();
}
