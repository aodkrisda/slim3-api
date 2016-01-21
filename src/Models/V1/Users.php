<?php

namespace App\Models\V1;

use Illuminate\Database\Capsule\Manager as DB;

class Users
{
    /**
     * Store a new user account
     *
     * @param   string  $name
     * @param   string  $email
     * @param   string  $password
     * @param   int     $level
     *
     * @return  int     $id
     */
    public function store($name, $email, $password, $level)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $activation   = bin2hex(openssl_random_pseudo_bytes(16));
        $created      = date('Y-m-d H:i:s');

        $id = DB::table('users')->insertGetId(
            ['users.name' => $name, 'users.email' => $email, 'users.password' => $passwordHash, 'users.activation' => $activation, 'users.created' => $created ]
        );

        return $id;
    }


    /**
     * Query a user based on email address
     *
     * @param   string  $email
     *
     * @return  array   $user
     */
    public function showFromEmail($email)
    {
        $user = DB::table('users')
            ->select('users.id', 'users.name', 'users.email', 'users.password', 'users.status', 'users.created')
            ->where('users.email', '=', $email)
            ->first();

        return !empty($user) ? $user : false;
    }

    
    /**
     * Query a user based on id
     *
     * @param   int    $id
     *
     * @return  array  $user
     */
    public function showFromId($id)
    {
        $user = DB::table('users')
            ->select('users.id', 'users.name', 'users.email')
            ->where('users.id', '=', $id)
            ->first();

        return !empty($user) ? $user : false;
    }

    
    /**
     * Query a user based on email address and activation key
     *
     * @param   string  $email
     * @param   string  $activation
     *
     * @return  array   $user
     */
    public function showFromEmailActivation($email, $activation)
    {
        $user = DB::table('users')
            ->select('users.id', 'users.email', 'users.status', 'users.created')
            ->where('users.email', '=', $email)
            ->where('users.activation', '=', $activation)
            ->first();

        return !empty($user) ? $user : false;
    }


    /**
     * Update a user status (activate user)
     *
     * @param  int  $id
     */
    public function activate($id)
    {
        DB::table('users')
            ->where('users.id', $id)
            ->update(['users.status' => 1]);
    }


    /**
     * Update user password
     *
     * @param  int     $id
     * @param  string  $password
     */
    public function updatePassword($id, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        DB::table('users')
            ->where('users.id', $id)
            ->update(['users.password' => $passwordHash]);
    }

}
