<?php
/**
 * Created by PhpStorm.
 * User: f
 * Date: 2018-06-13
 * Time: 6:46 PM
 */

namespace Util;


use BerkaPhp\Helper\SessionHelper;

class Request {

    public static function Data(){
        return SessionHelper::exist('Request') ? SessionHelper::_get('Request') : null;
    }

    public static function Post($validation, $callback) {

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if(sizeof($data) == 0)
            return self::Response(['error'=>true, 'message'=>'invalid method or empty argument']);
        else if($validation($data) !== true)
            return  $validation($data);
        else
            return $callback($data);

    }

    public static function GetData() {

        $data = [];

        if(Request::IsPost()) {

            if(sizeof($_POST) == 0) {

                $json = file_get_contents('php://input');
                $data = json_decode($json, true);

            }
            else {

                $data = $_POST;

            }
        }
        else if(Request::IsGet()) {

            $data = $_GET;
        }

        return $data;

    }

    public static function IsPost()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
            return true;
        return false;
    }

    public static function IsGet()
    {

        if($_SERVER['REQUEST_METHOD'] === 'GET')
            return true;
        return false;
    }

    public static function Response($data, $code = 201) {
        return print(json_encode($data));
    }

} 