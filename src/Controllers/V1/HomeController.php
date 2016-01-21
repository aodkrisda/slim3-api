<?php

namespace App\Controllers\V1;

/**
 * This class provides a json response detailing the version 1 api
 */
class HomeController
{    
    /**
     * Sets the version 1 API title, description, and links to API routes
     *
     * @return array
     */
    function index($request, $response, $args)
    {
        $uri = $request->getUri();
        $scheme = $uri->getScheme();
        $host = $uri->getHost();
        $basePath = $uri->getBasePath();

        $url = $scheme . '://' . $host . $basePath;

        $body = json_encode(
            [
                'title'       => 'A RESTful JSON API (v1)',
                'description' => 'Built on Slim framework version 3, this is version 1 of a RESTful JSON API.',
                'url'         => $url . '/v1',   
                'routes' => [
                    [
                        /*
                        '/' => [
                            'supports' => [
                                'HEAD',
                                'GET'
                            ],
                            'meta' => [
                                'self' => ''
                            ]
                        ],
                        '/register' => [
                            'supports' => [
                                'HEAD',
                                'GET',
                                'POST'
                            ],
                            'meta' => [
                                'self' => ''
                            ]
                        ]
                        */
                    ]
                ]
            ]
        );

        $response = $response->withHeader(
            'Content-type',
            'application/json'
        )
            ->write($body);

        return $response;
    }
}