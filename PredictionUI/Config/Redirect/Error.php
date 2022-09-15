<?php
namespace Config\Router;
use BerkaPhp\Helper\RedirectHelper;

/**
 * Created by PhpStorm.
 * User: Berka Ayowa
 * Date: 2018-07-13
 * Time: 3:23 AM
 */

class Error {

    public static function OnActionNotFound($queryString = ''){
        //die($queryString);
        RedirectHelper::redirect('/framework/page/actionnotfound'.$queryString);
    }

    public static function OnControllerNotFound($queryString = ''){
        //die($queryString);
        RedirectHelper::redirect('/framework/page/controllernotfound'.$queryString);
    }

    public static function OnNullRouter($queryString = ''){
        die($queryString);
    }

    public static function OnComponentNotFound($queryString = ''){
        die($queryString);
        RedirectHelper::redirect('/errors/componentnotfound/'.$queryString);
    }

    public static function OnModelNotFound($queryString = ''){
        die($queryString);
        RedirectHelper::redirect('/errors/modelnotfound/'.$queryString);
    }

    public static function OnViewTemplateNotFound($queryString = ''){
        die($queryString);
        RedirectHelper::redirect('/errors/modelnotfound/'.$queryString);
    }


}

?>