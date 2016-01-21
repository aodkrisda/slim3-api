<?php

namespace Helpers;

class Base
{
	/**
     * Encrypt the given data
     *
     * @param mixed $data Session data to encrypt
     * @return mixed $data Encrypted data
     */
    
    /**
     * Deprecate if not using
     */
    /*
    public function encrypt($data, $key)
    {
        $ivSize  = mcrypt_get_iv_size( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC );
        $iv      = mcrypt_create_iv( $ivSize, MCRYPT_RAND );
        $keySize = mcrypt_get_key_size( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC );
        $key     = substr( sha1( $key ), 0, $keySize );

        // add in our IV and base64 encode the data
        $data    = base64_encode(
            $iv.mcrypt_encrypt(
                MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_CBC, $iv
            )
        );
        return $data;
    }
    */


    /**
     * Decrypt the given session data
     *
     * @param mixed $data Data to decrypt
     * @return $data Decrypted data
     */

    /**
     * Deprecate if not using
     */

    /*
    public function decrypt($data, $key)
    {
        $data    = base64_decode( $data, true );

        $ivSize  = mcrypt_get_iv_size( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC );
        $keySize = mcrypt_get_key_size( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC );
        $key     = substr( sha1( $key ), 0, $keySize );

        $iv   = substr( $data, 0, $ivSize );
        $data = substr( $data, $ivSize );

        $data = mcrypt_decrypt(
            MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_CBC, $iv
        );

        return $data;
    }
    */


}