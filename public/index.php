<?php

/**
 * Composer autoloader
 */
require __DIR__ . '/../../vendor/autoload.php';


/**
 * API config
 */
require __DIR__ . '/../../config/api.php';


/**
 * Database config
 */
require __DIR__ . '/../../config/database.php';


/**
 * Configure a new instance of our api
 */
$settings = [];
$api = new \Slim\App($settings);


/**
 * Set up dependencies
 */
// require __DIR__ . '/../../src/dependencies.php';


/**
 * Register middleware
 */
// require __DIR__ . '/../../src/middleware.php';


/**
 * Register routes
 */
require __DIR__ . '/../../src/routes.php';


/**
 * Run das app!
 */
$api->run();
