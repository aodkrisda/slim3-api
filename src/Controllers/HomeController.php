<?php

namespace App\Controllers;

use App\Helpers\Json;

/**
 * This class provides a json response detailing the api
 */
class HomeController
{    
    /**
     * Sets an API title, description, and links to API versions
     *
     * @return array
     */
    function index($request, $response, $args)
    {
        $this->json = new Json($response);

        $uri = $request->getUri();
        $scheme = $uri->getScheme();
        $host = $uri->getHost();
        $basePath = $uri->getBasePath();

        $url = $scheme . '://' . $host . $basePath;

        $data = [
            'title'       => 'A RESTful JSON API',
            'description' => 'Built on Slim Framework 3.',
            'url'         => $url,
            'versions' => [
                [
                    'id'  => 1,
                    'url' => $url . '/v1'
                ]
            ]                
        ];

        return $this->json->success($data);
    }
}