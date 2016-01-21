<?php

namespace App\Controllers\V1;

// use Helpers\Auth;
// use Respect\Validation\Validator as v;
use App\Models\V1\Users;
use App\Helpers\Json;

/**
 * Activate a new user
 */
class ActivateController
{
    private $users;
    private $json;

    /**
     * Activate a new user by setting their "state" to 1
     *
     * @param string   $email
     * @param string   $key  32 characters in length
     *
     * @return array
     */
    public function index($request, $response)
    {
        /** need to restrict access at route level **/

        $this->users = new Users;
        $this->json  = new Json($response);

        $email = $request->getParam('email');
        $key   = $request->getParam('key');

        /** validate at route level??? **/
        // This needs to go into base functions and return some kind of json message
        // if (!v::email()->validate($email)) { return 'email dont comply'; };
        // if (!v::xdigit()->length(32, 32)->validate($key)) { return 'key dont comply'; };

        $user = $this->users->showFromEmailActivation($email, $key);

        if ($user && intval($user->status) === 0) {
            $this->users->activate($user->id);

            return $this->json->success(200, 'success', 'Account activated. You may now login with your email address and password.');
        }

        if ($user) {
            return $this->json->jsonResponse(500, 'error', 'Account activation failed. <a href="/lost-password">Need to reset your password?</a>');
        } else {
            return $this->json->jsonResponse(500, 'error', 'Account activation failed. Your user information wasn\'t found in our system.');
        }
    }

}