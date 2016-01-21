<?php

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Configure Illuminate Database and boot Eloquent
 */
$capsule = new Capsule;

$capsule->addConnection(array(
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => $_SERVER['DB_NAME'],
    'username'  => $_SERVER['DB_USER'],
    'password'  => $_SERVER['DB_PASS'],
    'charset'   => 'utf8',
    'collation' => 'utf8mb4_general_ci',
    'prefix'    => ''
));

$capsule->setAsGlobal();
$capsule->bootEloquent();