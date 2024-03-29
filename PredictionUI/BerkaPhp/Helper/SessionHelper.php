<?php
namespace BerkaPhp\Helper;

class SessionHelper
{

    function __construct()
    {
        # code...
    }

    /*
	* Creates an input field
	* @param  label of the input and an array of attributes
	* @return input field
	* @author berkaPhp Ayowa
	*/
    public static function add($key, $value) {
        self::startSession();

        if(isset($_SESSION[$key]) && is_array($_SESSION[$key])) {
            array_push($_SESSION[$key], $value);
        } else {
            $_SESSION[$key] = $value;
        }

        return true;
    }

    /*
	* Creates an input field
	* @param  label of the input and an array of attributes
	* @return input field
	* @author berkaPhp Ayowa
	*/
    public static function remove($key) {
        self::startSession();
        unset($_SESSION[$key]);
    }

    public static  function update($key, $value) {
        self::startSession();
        self::remove($key);
        $_SESSION[$key] = $value;

    }

    /*
	* Creates an input field
	* @param  label of the input and an array of attributes
	* @return input field
	* @author berkaPhp Ayowa
	*/
    public static function get($key) {
        self::startSession();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;

    }

    public static function _get($key) {
        self::startSession();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function exist($key) {
        self::startSession();
        return isset($_SESSION[$key]);
    }

    /*
	* Creates an input field
	* @param  label of the input and an array of attributes
	* @return input field
	* @author berkaPhp Ayowa
	*/
    public static function kill() {
        self::startSession();
        session_unset();
        session_destroy();
    }

    public static function routing($prefix = '') {
        if(!empty($prefix)) {
            $current_prefix = self::_get('prefix');
            //echo $current_prefix;
            if($current_prefix != $prefix) {
                self::update('prefix', $prefix);
                //self::add('prefix', $prefix);
            }
        } else {
            return self::_get('prefix');
        }

    }

    public static function startSession() {
        self::start();
    }

    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}
?>