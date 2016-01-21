<?php

/**
 * Define all your routes within this file
 */
$app->get('/', 'App\Controllers\HomeController:index')
	->setName('home');

/*
$app->get('/', function ($request, $response, $args) {
    echo "Hello World";
});
*/

/*
$app->get('/hello/{name}', function ($request, $response, $args) {
    echo "Hello, " . $args['name'];
});
*/


$app->group('/v1', function() use ($app) {

	$app->get('', 'App\Controllers\V1\HomeController:index');

	$app->group('/register', function() use ($app) {
		$app->post('', /*Auth Middleware, */'App\Controllers\V1\RegisterController:post');
		$app->get('/create', /*Auth Middleware, */'App\Controllers\V1\RegisterController:create');
	});

	$app->group('/signin', function() use ($app) {
		$app->post('', /*Auth Middleware, */'App\Controllers\V1\SigninController:post');
		$app->get('/create', /*Auth Middleware, */'App\Controllers\V1\SigninController:create');
	});

	$app->get('/activate', /*Auth Middleware, */'App\Controllers\V1\ActivateController:index');

});
