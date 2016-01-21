<?php

namespace Middleware;

class Auth
{
    /**
     * Deprecate if not using
     */

    /*
	public function authorized()
    {
        return isset($_SESSION['signedIn'] ) && $_SESSION['signedIn'] ? true : false;
    }
    */


    /**
     * Restrict access based on authorization
     *
     * $privacy states: private, anonymous
     */

    /**
     * Deprecate if not using
     */

    /*
    public function restrictAccess($privacy)
    {
        $authorized = self::authorized();

        if (!$authorized && $privacy === 'private') {
            echo 'json error response: must be authenticated to view this area (401)';
            die();
        }

        if ($authorized && $privacy === 'anonymous') {
            echo 'json error response: must be anonymous to view this area (403)';
            die();
        }
    }
    */
}