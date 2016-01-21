<?php

namespace App\Controllers\V1;

// use Helpers\Auth;
// use Respect\Validation\Validator as v;
use App\Models\V1\Users;
use App\Helpers\Json;

/**
 * Verify the users email/password combination
 */
class SigninController
{
    private $users;
    private $json;

    /**
     * Check the email/password
     *
     * @param  string  $email
     * @param  string  $password  6 to 55 characters in length
     */
    public function post($request, $response)
    {
        /** need to restrict access at route level **/

        $this->users = new Users;
        $this->json  = new Json($response);

        $email    = $request->getParam('email');
        $password = $request->getParam('password');

        /** validate at route level??? **/
        // This needs to go into base functions and return some kind of json message
        // if (!v::email()->validate($email)) { return 'email dont comply'; };
        // if (!v::length(6, 55)->validate($password)) { return 'password dont comply'; };

        $user = $this->users->showFromEmail($email);

        if (!$user) {
            return $this->json->jsonResponse(500, 'error', 'Signin failed. Check your email address and password. <a href="/lost-password">Need to reset your password?</a>');
        }

        if (intval($user->status) === 0) {
            return $this->json->jsonResponse(500, 'error', 'Signin failed. This account has not been activated yet. Please check your email for activation instructions. <a href="/lost-password">Need to reset your password?</a>');
        }

        if (password_verify($password, $user->password)) {
            /**
             * If and when the password algorithm needs to update activate the following code
             */
            /*
            if (password_needs_rehash($hash, $algorithm, $options)) {
                $hashedPassword = password_hash($password, $algorithm, $options);
                // Store new hash in db
            }
            */

            /**
             * Need to convert authentication to the oAuth way
             */
            /*
            session_regenerate_id(true);

            $_SESSION['signedIn']   = true;
            $_SESSION['userId']     = $user['id'];
            $_SESSION['userAgent']  = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['remoteAddr'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['token']      = 0;
            */
            
            return $this->json->jsonResponse(200, 'success');
            
        } else {
            return $this->json->jsonResponse(500, 'error', 'Signin failed. Check your email address and password. <a href="/lost-password">Need to reset your password?</a>');
        }
    }


    /**
     * Show the form for signin
     *
     * @return  array  $body
     */
    public function create($request, $response)
    {
        $this->json  = new Json($response);

        $data = [
            'email' => [
                'label' => 'Email',
                'type'  => 'email'
            ],
            'password' => [
                'label' => 'Password',
                'type'  => 'password'
            ]
        ];

        return $this->json->jsonResponse(200, 'success', null, $data);
    }

}
