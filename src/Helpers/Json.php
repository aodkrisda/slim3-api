<?php

namespace App\Helpers;

/**
 * Some JSON functions to reduce repetition
 */
class Json
{
    protected $app;

    /**
     * @param   array   $app
     */
    public function __construct()
    {
        $this->app  = new \Slim\App();
    }


    /**
     * Provide an informational json reponse using the provided $response object
     *
     * @param    int      $code      3 digits
     * @param    string   $status
     * @param    string   $message
     * @param    array    $data
     *
     * @return   array    $response
     */
    public function informational($data = [], $message = [], $code = 100, $status = 'informational')
    {
        if ($message) {
            $message = ['message' => $message];
        }

        $data = json_encode(array_merge($message, ['data' => $data]));

        $response = $this->app->response->withStatus($code)
            ->withHeader('Content-type', 'application/json')
            ->write($data);

        return $response;
    }


    /**
     * Provide a success json reponse using the provided $response object
     *
     * @param    int      $code      3 digits
     * @param    string   $status
     * @param    string   $message
     * @param    array    $data
     *
     * @return   array    $response
     */
    public function success($data = [], $message = [], $code = 200, $status = 'success')
    {
        if ($message) {
            $message = ['message' => $message];
        }

        $data = json_encode(array_merge($message, ['data' => $data]));

        $response = $this->app->response->withStatus($code)
            ->withHeader('Content-type', 'application/json')
            ->write($data);

        return $response;
    }


    /**
     * Provide a redirect reponse using the provided $response object
     *
     * @param    int      $code      3 digits
     * @param    string   $status
     * @param    string   $uri
     *
     * @return   array    $response
     */
    public function redirect($uri, $code = 300, $status = 'redirect')
    {
        $response = $this->app->response->withStatus($code)
            ->withHeader('Location', $uri);

        return $response;
    }


    /**
     * Provide a failure json reponse using the provided $response object
     *
     * @param    int      $code      3 digits
     * @param    string   $status
     * @param    string   $message
     * @param    array    $data
     *
     * @return   array    $response
     */
    public function fail($message, $data = [], $code = 400, $status = 'fail')
    {
        $code   = ['code'    => $code];
        $status = ['status'  => $status];

        if ($message) {
            $message = ['message' => $message];
        }

        $data = json_encode(array_merge($code, $status, $message, ['data' => $data]));

        $response = $this->app->response->withStatus($code)
            ->withHeader('Content-type', 'application/json')
            ->write($data);

        return $response;
    }


    /**
     * Provide an error json reponse using the provided $response object
     *
     * @param    int      $code      3 digits
     * @param    string   $status
     * @param    string   $message
     *
     * @return   array    $response
     */
    public function error($message, $code = 500, $status = 'error')
    {
        $code   = ['code'    => $code];
        $status = ['status'  => $status];

        if ($message) {
            $message = ['message' => $message];
        }

        $data = json_encode(array_merge($code, $status, $message));

        $response = $this->app->response->withStatus($code)
            ->withHeader('Content-type', 'application/json')
            ->write($data);

        return $response;
    }
}
