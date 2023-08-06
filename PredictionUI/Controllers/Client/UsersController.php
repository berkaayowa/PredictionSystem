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

    private $mailer;

    function __construct() {
        parent::__construct(false);
        $this->mailer = $this->loadComponent("Email");
    }

    /* Display all users from database
    *  Client action in this controller
    *  @author berkaPhp
    */

    function index() {
        RedirectHelper::redirect('/users/login');
    }

    function signup() {

        if($this->is_set($this->getPost())) {

            $user = @T::Find('user')
                ->Where('user.username' , '=', $this->getPost()['emailAddress'])
                ->Where('user.isDeleted', '=', Check::$False)
                ->FetchFirstOrDefault();

            if (!$user->IsAny()) {

                $data = $this->getPost();
                $activationCode = md5($data['emailAddress'] . $data['name']);

                $user->name = $data['name'];
                $user->surname = $data['surname'];
                $user->password = md5($data['password']);
                $user->username = $data['emailAddress'];
                $user->emailAddress = $data['emailAddress'];
                $user->confirmationCode = $activationCode;

                $status = @T::Find('user_status')
                    ->Where('code' , '=', 'PFC')
                    ->Where('isDeleted', '=', Check::$False)
                    ->FetchFirstOrDefault();

                $role = @T::Find('user_role')
                    ->Where('code' , '=', 'CLT')
                    ->Where('isDeleted', '=', Check::$False)
                    ->FetchFirstOrDefault();

                $user->userStatusId = $status->id;
                $user->userRoleId = $role->id;

                if ($user->Save()) {

                    $this->view->set('activationCode', $activationCode);
                    $this->view->set('firstName', $data['name']);

                    $content = $this->view->renderGetContent('Views/Client/Users/Email/welcome');
                    $isSent = $this->mailer->send(EMAIL_FROM_NAME, "Welcome ".ucfirst($data['name']), "", $content, $this->getPost()['emailAddress']);

                    return $this->jsonFormat(['success'=>true,'error'=> false, 'message'=> "Your account has been created successfully , and a verification email has been sent to your email (".$data['emailAddress'].")", 'link'=>'/pages']);
                } else {
                    return $this->jsonFormat(['error'=> true, 'message'=>'Error could not save this user', 'success'=>false]);
                }

            } else {
                return $this->jsonFormat(['error'=> true,'message'=>'This email has been used already', 'success'=>false]);
            }
        }

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