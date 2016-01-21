<?php

namespace Controllers\V1;

use Helpers\Auth;
use Respect\Validation\Validator as v;
use Models\V1\Users;
use Models\V1\PasswordResets;

class PasswordResetController
{
	public function index($request, $response, $service, $app)
	{
        Auth::restrictAccess('anonymous');

        $email = $request->param('email');
        $token = $request->param('token');

        self::validatePasswordResetRequest($email, $token);
	}


	public function post($request, $response, $service, $app)
	{
        Auth::restrictAccess('anonymous');

		$app->users          = new Users;
		$app->passwordResets = new PasswordResets;

		$email               = $request->param('email');
        $token               = $request->param('token');

        $passwordReset = self::validatePasswordResetRequest($email, $token);

        $body                = json_decode($request->body());

        $newPassword         = $body->newPassword;
        $confirmPassword     = $body->confirmPassword;

        if (!v::length(6, 55)->validate($newPassword)) { return 'password 1 dont comply'; };
        if (!v::length(6, 55)->validate($confirmPassword)) { return 'password 2 dont comply'; };
        if (!v::equals($newPassword)->validate($confirmPassword)) { return 'passwords dont match'; };

        // user update password
        $app->users->updatePassword($passwordReset['userId'], $newPassword);

        // delete the passwordReset row after use
        $app->passwordResets->destroy($passwordReset['id']);
	}


	public function create()
	{
		$result = [
            'newPassword' => [
                'label'   => 'New Password',
                'type'    => 'password'
            ],
            'confirmPassword' => [
                'label'   => 'Confirm Password',
                'type'    => 'password'
            ]
        ];

        // $response->code( 200 );

        $response->json($result);
        // $response->lock();
	}


	public function validatePasswordResetRequest($email, $token)
    {
        Auth::restrictAccess('anonymous');
        
    	$passwordResets = new PasswordResets;

    	// This needs to go into base functions and return some kind of json message
        if (!v::email()->validate($email)) { return 'email dont comply'; };
        if (!v::xdigit()->length(32, 32)->validate($token)) { return 'token dont comply'; };

        $passwordReset = $passwordResets->show($email);

        // Not going to reveal whether the user account was found...

        if (empty($passwordReset['token']) || empty($passwordReset['created'])) {
        	echo 'password reset request not found. forward. please submit a password reset request first';
        	die();
        }

        $created = strtotime($passwordReset['created']);
        $now     = strtotime(date('Y-m-d H:i:s'));
        $diff    = round(($now - $created) / 60, 2);

        if ( intval($diff) > 60) {
        	echo 'password reset has expired. 60 minutes max. submit another reset request';
        	die();
        }

        if ( password_verify($token, $passwordReset['token'])) {
        	// probably shouldnt disclose this. just send json success
        	echo 'password matches. proceed to reset.';
        }

        return $passwordReset;
    }
}