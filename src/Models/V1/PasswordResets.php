<?php

namespace Models\V1;

use RedBeanPHP\R;

class PasswordResets
{
    public function show($email)
    {
    	$passwordReset = R::getRow(
            'SELECT `users`.`id` AS `userId`, `passwordResets`.`id`, `passwordResets`.`token`, `passwordResets`.`created`
            	FROM ( `users` )
            LEFT JOIN `passwordResets`
            	ON ( `passwordResets`.`userId` = `users`.`id` )
            WHERE `users`.`email` = :email',

            [ ':email' => $email ]
        );

        return !empty($passwordReset) ? $passwordReset : false;
    }

    /**
     * Store a new password reset request
     *
     * @return int
     */
    public function update($userId, $token)
    {
        $tokenHash = password_hash($token, PASSWORD_BCRYPT);
        $created   = date( 'Y-m-d H:i:s' );

        $id = R::exec(
            'REPLACE INTO passwordResets (`userId`, `token`, `created`)
				VALUES ( :userId, :token, :created )', [
					':userId'   => $userId,
					':token'   => $tokenHash,
					':created' => $created
				]
		);

        return $id;
    }

    public function destroy($id)
    {
    	R::exec(
            'DELETE
    			FROM `passwordResets`
    		WHERE `passwordResets`.`id` = :id',
    		[
    			':id'   => $id
    		]
    	);
    }
}