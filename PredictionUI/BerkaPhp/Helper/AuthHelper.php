<?php
namespace BerkaPhp\Helper;
/**
 * Created by PhpStorm.
 * User: Berka
 * Date: 5/14/2017
 * Time: 8:38 AM
 */

use \BerkaPhp\Helper;

class Auth {

    public static function GetDefaultUsername () {
        $val = md5(\Util\Helper::GetCurrentDomainUrl()) . "_user";
        return $val;
    }

    public function _construct() {

    }

    /*
    * add login session default name is user
    * @param user object
    * @param name of the user object optional
    * @return bool or null
    * @author berkaPhp Ayowa
    */

    public static function Login($user, $name ="") {

        if(!self::IsUserLogged()) {

            switch(empty($name)) {
                case true:
                    return SessionHelper::add(self::GetDefaultUsername(), $user);
                    break;
                default:
                    return SessionHelper::add($name, $user);
            }

        }

        return false;
    }

    /*
    * removing user session logout
    * @param  user object name optional
    * @author berkaPhp
    */

    public static function Logout($name = "") {

        switch(empty($name)) {
            case true:
                SessionHelper::remove(self::GetDefaultUsername());
                break;
            default:
                SessionHelper::remove($name);
        }

    }

    /*
    * Checks if user is logged in
    * @return user object name optional
    * @author berkaPhp
    */

    public static function IsUserLogged($name = ''){

        switch(empty($name)) {
            case true:

                return SessionHelper::exist(self::GetDefaultUsername());
                break;
            default:
                return SessionHelper::exist($name);
        }

    }

    /*
    * Creates an input field
    * @param  label of the input and an array of attributes
    * @return input field
    * @author berkaPhp Ayowa
    */

    public static function IsUseRole($role, $force_to_log = false, $name = '', $role_name = '') {

        $name = !empty($name) ? $name : self::GetDefaultUsername();
        $role_name = !empty($role_name) ? $role_name : 'role_name';

        if(self::IsUserLogged()) {

            $actual_role = SessionHelper::get($name) ? SessionHelper::get($name)[$role_name] : "";
            return (strtolower($actual_role) == $role) ? true : false;

        } else {

            if(!$force_to_log) {
                return false;
            } else {
                RedirectHelper::redirect(LOGIN_URL);
            }

        }

    }

    /*
    * Creates an input field
    * @param  label of the input and an array of attributes
    * @return input field
    * @author berkaPhp Ayowa
    */

    public static function GetActiveUser($force_to_log = false, $key = '', $name = '') {

        $name = !empty($name) ? $name : self::GetDefaultUsername();

        if(self::IsUserLogged()) {

            if(!empty($key)) {
                return isset(SessionHelper::get($name)[$key]) ? SessionHelper::get( $name)[$key] : null;
            }

            return (SessionHelper::exist($name)) ?  unserialize(SessionHelper::get($name)) : null;

        } else {

            if($force_to_log) {
                RedirectHelper::redirect(LOGIN_URL);
            } else {
                return null;
            }

        }

    }
}