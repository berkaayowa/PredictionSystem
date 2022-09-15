<?php
namespace Config\Router;
use BerkaPhp\Helper\Auth;
use BerkaPhp\Helper\Debug;
use BerkaPhp\Helper\RedirectHelper;
use BerkaPhp\Helper\SessionHelper;
use BerkaPhp\Router\Dispatcher\Route;

/**
 * Created by PhpStorm.
 * User: f
 * Date: 2018-07-13
 * Time: 2:44 AM
 * @param $router
 */
class Router {


    public static function Setup($router){

        /**
         * Created by PhpStorm.
         * User: Berka
         * Date: 2018-07-13
         * Time: 2:44 AM
         * setup prefix
         */
        $router->prefix
        (
            [
                'client'=>[
                    'name'=>'Client',
                    'home'=>'pages'
                ],
                'email'=>[
                    'name'=>'Email',
                    'home'=>'request'
                ],
                'sms'=>[
                    'name'=>'Sms',
                    'home'=>'request'
                ],
                'job'=>[
                    'name'=>'Job',
                    'home'=>'users'
                ]
            ],
            ['default'=>'client']
        );

        /**
         * Created by PhpStorm.
         * User: Berka
         * Date: 2018-07-13
         * Time: 2:44 AM
         * setup routing
         */

        $router->route('/', function ($route) {

            if(strtolower($route['controller']) == 'payment' && strtolower($route['action']) == 'notice') {

            } else if(strtolower($route['controller']) == 'request' && strtolower($route['action']) == 'send') {

            } else if(strtolower($route['prefix']['name']) == 'job') {

            } else if(strtolower($route['prefix']['name']) == 'client' && strtolower($route['controller']) == 'pages' && strtolower($route['action']) == 'index') {

            }
            else if(strtolower($route['prefix']['name']) == 'client' && $route['controller'] == '' && $route['action'] == '') {

            }
            else {
                if(!Auth::IsUserLogged()){
                    $route['controller'] = 'users';
                    $route['action'] = 'signin';
                }
            }

            Route::to($route);

        });


        return $router;

    }
}

?>