<?php

namespace BerkaPhp\Helper;
/**
 * Created by PhpStorm.
 * User: berka
 * Date: 7/28/17
 * Time: 11:06 PM
 */
class Rand
{

    public static function uniqueDigit($min = null, $max = null)
    {
        if($min != null && $max != null) {
            return mt_rand($min, $max);
        } else {
            return mt_rand(1000000, 9999999);
        }       
    }

    public static function newGuid() {

        // Create a token
        $token      = $_SERVER['HTTP_HOST'];
        $token     .= $_SERVER['REQUEST_URI'];
        $token     .= uniqid(rand(), true);

        // GUID is 128-bit hex
        $hash        = strtoupper(md5($token));

        // Create formatted GUID
        $guid        = '';

        // GUID format is XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX for readability
        $guid .= substr($hash,  0,  8) .
            '-' .
            substr($hash,  8,  4) .
            '-' .
            substr($hash, 12,  4) .
            '-' .
            substr($hash, 16,  4) .
            '-' .
            substr($hash, 20, 12);

        return strtolower($guid) ;

    }


}

?>