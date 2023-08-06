<?php
namespace Controller\Client;
use BerkaPhp\Controller\BerkaPhpController;
use BerkaPhp\Helper\Auth;
use BerkaPhp\Helper\Debug;
use BerkaPhp\Helper\RedirectHelper;
use BerkaPhp\Helper\SessionHelper;
use BrkORM\T;
use Helper\Check;
use Util\Helper;

class UsersController extends BerkaPhpController
{

    function __construct() {
        parent::__construct(false);
    }

    /* Display all users from database
    *  Client action in this controller
    *  @author berkaPhp
    */

    function index() {
        RedirectHelper::redirect('/users/login');
    }

    function test($option =  null)
    {

        $data = json_encode($option);

        $log = T::Create('app_log');
        $log->logData =  $data;
        $log->createdDate = NOW;
        @$log->Save();


        // Helper::SendPushNotification2();
    }

    function appsignin($option) {

        $user = @T::Find('user')
            ->Join('role', 'role.Id = user.refRoleId')
            ->Join('status', 'status.Id = user.refStatusId')
            ->Where('user.id' , '=', $option['args']['query']['userId'])
            ->Where('user.isDeleted', '=', 0)
            ->FetchFirstOrDefault();

        if ($user->IsAny()) {

            if($user->status->code == 'PNC') {

                if (SessionHelper::exist('user')) {
                    SessionHelper::remove('user');
                }

                SessionHelper::add('user', serialize($user));

                $user->lastSignIn = NOW;
                $user->Save();

                $prefix = 'client';

                if($user->role->code == 'AGA')
                    $prefix = 'agency';
                elseif ($user->role->code = "ADM")
                    $prefix = 'admin';

                RedirectHelper::redirect('/'.$prefix);

//                    return $this->jsonFormat(['success'=>true,'error'=> false, 'message'=> "Successfully logged in", 'link'=>'/'.$prefix.'']);
            } else if($user->status->code == 'PFC' || $user->isPhoneNumberConfirmed == Check::$False) {
                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Your account is not verified yet']);
            } else if($user->status->code == 'APD') {
                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Your account has been suspended, contact support']);
            } else {
                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Your account status is invalid, contact support']);
            }

        } else {
            return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Invalid username or password']);
        }

        $this->view->render();

    }

    function login() {

        if(sizeof($this->getPost()) > 0) {

            $user = @T::Find('user')
                ->Join(['user_role'=>'role'], 'role.id = user.userRoleId')
                ->Join(['user_status'=>'status'], 'status.id = user.userStatusId')
                ->Where('user.username' , '=', $this->getPost()['username'])
                ->Where('user.password' , '=',  md5($this->getPost()['password']))
                ->Where('user.isDeleted', '=', Check::$False)
                ->FetchFirstOrDefault();

            if ($user->IsAny()) {

                if($user->status->code == 'PNC') {

                    if (SessionHelper::exist(Auth::GetDefaultUsername())) {
                        SessionHelper::remove(Auth::GetDefaultUsername());
                    }

                    SessionHelper::add(Auth::GetDefaultUsername(), serialize($user));

                    $user->lastSignIn = DATE_NOW;
                    $user->Save();

                    $prefix = 'client';

                    if($user->role->code == 'AGA')
                        $prefix = 'agency';
                    elseif ($user->role->code = "ADM")
                        $prefix = 'admin';

                    return $this->jsonFormat(['success'=>true,'error'=> false, 'message'=> "Successfully logged in", 'link'=>'/pages']);
                } else if($user->status->code == 'PFC' || $user->isPhoneNumberConfirmed == Check::$False) {
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Your account is not verified yet']);
                } else if($user->status->code == 'APD') {
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Your account has been suspended, contact support']);
                } else {
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Your account status is invalid, contact support']);
                }

            } else {
                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Invalid username or password']);
            }
        }

        $this->view->set('title', 'Sign in');
        $this->view->render();
    }

    function logout() {
        SessionHelper::remove(Auth::GetDefaultUsername());
        SessionHelper::kill();
        RedirectHelper::redirect('/');
    }

    function unauthorized() {
        //$this->overWriteLayout('/Views/Client/Layout/
        //secondSimpleLayout');
        $this->view->render();
    }

    function onResourceReady($resource){
        //$resource['resources']['template']['path'] = '/Views/Client/Layout/secondSimpleLayout';
//            $this->overWriteLayout('/Views/Client/Layout/simpleLayout');
        return $resource;
    }

    function profile() {

        $this->view->render();
    }


}

?>