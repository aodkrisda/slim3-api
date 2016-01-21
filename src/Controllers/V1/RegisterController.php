<?php

namespace App\Controllers\V1;

// use Helpers\Auth;
use Respect\Validation\Validator as v;
use App\Models\V1\Users;
use App\Helpers\Json;

/**
 * Register a new user account and create form inputs
 */
class RegisterController
{
    private $users;
    private $json;

    /**
     * Create a new user account
     *
     * @param   string  $name      2 to 75 characters in length
     * @param   string  $email
     * @param   string  $password  6 to 55 characters in length
     *
     * @return  array
     */
    public function post($request, $response)
    {
        /** need to restrict access at route level **/

        $this->users = new Users;
        $this->json  = new Json($response);

        $name     = $request->getParam('name');
        $email    = $request->getParam('email');
        $password = $request->getParam('password');

        /** validate at route level??? **/

        $user = $this->users->showFromEmail($email);

        if ($user) {
            return $this->json->fail(
                409,
                'fail',
                'Registration failed. That email address is already in use. <a href="/password-reset">Need to reset your password?</a>'
            );
        }

        $id = $this->users->store($name, $email, $password, 0);

        $user = $this->users->showFromId($id);

        /** send email message **/

        return $this->json->success(
            201,
            'success',
            'Registration successful! Check your email for instructions to activate your account.',
            $user
        );
    }


    /**
     * Show the form for creating a new account
     *
     * @return  array  $response
     */
    public function create($request, $response)
    {
        $this->json = new Json();

        $data = [
            'name' => [
                'label' => 'Name',
                'type'  => 'text'
            ],
            'email' => [
                'label' => 'Email',
                'type'  => 'email'
            ],
            'password' => [
                'label' => 'Password',
                'type'  => 'password'
            ],
            'passwordConfirm' => [
                'label' => 'Confirm Password',
                'type'  => 'password'
            ]
        ];

        return $this->json->success($data);
    }

}
