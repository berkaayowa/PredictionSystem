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
                    'home'=>'prediction'
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

            } else if(strtolower($route['prefix']['name']) == 'job') {

            } else if(strtolower($route['prefix']['name']) == 'client' && $route['controller'] == 'pages' && $route['action'] == 'policy') {

            }
            if(strtolower($route['prefix']['name']) == 'client' && $route['controller'] == 'pages' && $route['action'] == 'livescore') {

            }
            else if(strtolower($route['prefix']['name']) == 'client' && $route['controller'] == 'users' && $route['action'] == 'signup') {

            }
            else if(strtolower($route['prefix']['name']) == 'client' && $route['controller'] == 'users' && $route['action'] == 'activate') {

            }
            else if(strtolower($route['prefix']['name']) == 'client' && $route['controller'] == 'users' && $route['action'] == 'login') {

            }
            else {
                if(!Auth::IsUserLogged()){
                    $route['controller'] = 'prediction';
                    $route['action'] = 'index';
                }
            }

            Route::to($route);

        });


        return $router;

    }
}

?>