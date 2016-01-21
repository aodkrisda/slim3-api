<?php

namespace Controllers\V1;

use Helpers\Auth;
use Respect\Validation\Validator as v;
use Models\V1\Users;
use Models\V1\PasswordResets;

class LostPasswordController
{
	public function post($request, $response, $service, $app)
	{
        Auth::restrictAccess('anonymous');
        
		$app->users          = new Users;
		$app->passwordResets = new PasswordResets;

        $body                = json_decode($request->body());

        $email               = $body->email;

        if (!v::email()->validate($email)) { return 'email dont comply'; };

        $user = $app->users->showFromEmail($email);

        // Maybe add some limit on request frequency here
        if ($user) {
        	$token = bin2hex(openssl_random_pseudo_bytes(16));
        	$app->passwordResets->update($user['id'], $token);

        	echo 'password reset request submitted with email: ' . $email . ' and token: ' . $token;
        } else {
        	// dont disclose that the user wasnt found? or do? do or do not. there is no try
        	echo 'account not found';
        }
	}


	/**
     * Show the form for submitting a lost password request
     *
     * @return array
     */
    public function create($request, $response)
    {
        $result = [
            'email' => [
                'label' => 'Email',
                'type'  => 'email'
            ]
        ];

        // $response->code( 200 );

        $response->json($result);
        // $response->lock();
    }
}