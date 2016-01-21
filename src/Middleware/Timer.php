<?php

namespace App\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class Timer implements ServiceProviderInterface
{
    /**
     * Register service provider
     *
     * @param  \Pimple\Container $container
     */
    public function register(Container $container)
    {
        $container['timer'] = $this;
    }


    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        // before
        $start = microtime(true);

        // call next middleware
        $response = $next($request, $response);

        // after
        $total = microtime(true) - $start;
        $response->write("<!-- Generated in $total seconds. -->");

        return $response;
    }
}