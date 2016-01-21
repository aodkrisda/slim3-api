<?php

namespace Helpers;

use Helpers\Base;
use RedBeanPHP\R;

class Session
{
	/**
     * Deprecate if not using
     */

	/*
	public function __construct()
	{
		$this->key = $_SERVER['XFW8_APP_KEY'];

		// Set handler to overide SESSION
		session_set_save_handler(
			[$this, 'open'],
			[$this, 'close'],
			[$this, 'read'],
			[$this, 'write'],
			[$this, 'destroy'],
			[$this, 'gc']
		);

		// Start the session
		// session_start();

		$cookieParams = session_get_cookie_params();

        session_set_cookie_params(
            $cookieParams['lifetime'],
            $cookieParams['path'],
            $_SERVER['XFW8_COOKIE_DOMAIN'],
            $cookieParams['secure'],
            $cookieParams['httponly']
        );

        session_name($_SERVER['XFW8_SESSION_NAME']);

        session_start();

        setcookie(session_name(), session_id(), time() + 3600, '/', $_SERVER['XFW8_COOKIE_DOMAIN']);
	}

	public function open()
	{
		return R::testConnection() ? true : false;
	}

	public function close()
	{
		return R::close() ? true : false;
	}

	public function read( $id )
	{
		$session = R::getRow(
			'SELECT `sessions`.`data`
            	FROM `sessions`
            WHERE `sessions`.`id` = :id',

        	[ ':id' => $id ]
		);

		return !empty($session) ? Base::decrypt($session['data'], $this->key) : '';
	}

	public function write($id, $data)
	{
		$data = Base::encrypt($data, $this->key);
		$access = time();

		$id = R::exec(
			'REPLACE INTO sessions
			VALUES ( :id, :access, :data )',
			[
				':id'     => $id,
				':access' => $access,
				':data'   => $data
			]
		 );

        return !empty($id) ? true : false;
	}

	public function destroy($id)
	{
		try	{
			R::exec(
				'DELETE
					FROM `sessions`
				WHERE `sessions`.`id` = :id',
				[
					':id' => $id
				]
			);

			return true;
		} catch(Exception $e) {
			return false;
		}
	}

	public function gc($max)
	{
		$old = time() - $max;

		try	{
			R::exec(
				'DELETE
					FROM `sessions`
				WHERE `sessions`.`access` < :old',
				[
					':old' => $old
				]
			);

			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	*/
}