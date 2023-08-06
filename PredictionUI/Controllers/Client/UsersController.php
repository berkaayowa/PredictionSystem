<?php
namespace Controller\Client;
use BerkaPhp\Controller\BerkaPhpController;
use BerkaPhp\Helper\Auth;
use BerkaPhp\Helper\Debug;
use BerkaPhp\Helper\Rand;
use BerkaPhp\Helper\RedirectHelper;
use BerkaPhp\Helper\SessionHelper;
use BrkORM\T;
use Helper\Check;
use Resource\Label;
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
                    $this->view->set('firstName',  ucfirst($data['name']));

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

    function activate($params = '') {

        if(is_array($params) && isset($params['params'])) {

            $verificationCode = $params['params'];

            $user = @T::Find('user')
                ->Join(['user_role'=>'role'], 'role.id = user.userRoleId')
                ->Join(['user_status'=>'status'], 'status.id = user.userStatusId')
                ->Where('user.confirmationCode' , '=', $verificationCode)
                ->Where('user.isDeleted', '=', Check::$False)
//                ->Where('status.code', '=', 'PFC')
                ->FetchFirstOrDefault();

            if ($user->IsAny()) {

                if ($user->isUserVerified == Check::True()) {

                    $this->view->set('error', true);
                    self::homeNotification('This account is activated already. click login on top :)');

                } else {

                    $user->isUserVerified = Check::True();

                    if($user->Save()) {
                        $this->view->set('success', true);
                        self::homeNotification('Account activated successfully, you can login now , enjoy :) ');
                    } else {
                        $this->view->set('error', true);
                        self::homeNotification('Account could not be activated, try again');
                    }
                }
            }
        } else {
            self::homeNotification('Account could not be found, please signup.');
        }

    }

    function homeNotification($message)
    {
        RedirectHelper::redirect("/pages?n=" . $message);
    }

    function profile() {

        if(!Auth::IsUserLogged()){
            RedirectHelper::redirect("/users/signin");
        }

        $user = T::Find('user', Auth::GetActiveUser(false)->id)
            ->FetchFirstOrDefault();

        $this->view->set('menuTitle', 'Profile');
        $this->view->set('user', $user);
        $this->view->render();

    }

    function forgotpassword(){

        if($this->is_set($this->getPost())) {

            $data = $this->getPost();

            if(sizeof($data) > 0) {

                $user = T::Find('user')
                    ->Where('user.email' , '=', $data['Email'])
//                        ->Where('user.password' , '=',  $data['Password'])
                    ->FetchFirstOrDefault();

                if($user->IsAny()) {

                    $code = Rand::uniqueDigit(12, 1900);
                    $resetCode = md5($user->password.$user->email.$code);
                    $user->verificationToken = $resetCode;
                    $user->verificationCode = $code;

                    if($user->Save()) {

                        $this->view->set('userDetails', $user);

                        $body = $this->view->renderGetContent('Views/Email/default');
                        $isSent = $this->mailer->send(EMAIL_FROM_NAME, SYS_NAME." Reset Password Link", "", $body, $user->email);

                        if($isSent) {
                            return $this->jsonFormat(['success'=>true,'error'=> false, 'link'=>'/users/resetpassword?token='.$user->verificationToken, 'message'=> Label::Success('ResetPasswordEmailed') . ' ('.$user->email.')']);
                        } else{
                            return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> Label::Error('ResetPasswordEmailed')]);
                        }

                    } else {
                        return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> Label::Error('SaveRestPasswordCode')]);
                    }


                }else {
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> Label::Error('EmailNotFound')]);
                }

            }
        }

//        $this->overWriteLayout('/Client/Layout/layoutNoMenu');
        $this->view->set('title', 'Forgot Password');
        $this->view->render();
    }

    function resetpassword($option = array()) {

        $code = "";
        $user = T::Find('user')
            ->Where('user.verificationToken' , '=', $option['args']['query']['token'])
            ->FetchFirstOrDefault();

        if(key_exists('code', $option['args']['query']))
            $code = $option['args']['query']['code'];

        if(!$user->IsAny())
            return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "Invalid Token"]);

        $data = $this->getPost();

        if(sizeof($data) > 0) {

            if( strlen($data["Password"]) < 5)
                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "Minimum 8 characters are required for password"]);

            if($data["Password"] != $data["CPassword"])
                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "Passwords don't match"]);

            if($code == "")
                $code = $data["Code"];

            if($user->verificationCode != $code)
                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "Invalid Request Code"]);

            $user->verificationToken = "";
            $user->verificationCode = "";

            if($user->Save()) {

                $this->view->set('userDetails', $user);

                $body = $this->view->renderGetContent('Views/Email/default');
                $isSent = $this->mailer->send(EMAIL_FROM_NAME, SYS_NAME." Password Changed", "", $body, $user->email);

                if($isSent) {
                    return $this->jsonFormat(['success'=>true,'error'=> false, 'link'=>'/users/signin', 'message'=> "Your password has been changed"]);
                } else{
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> Label::Error('ResetPasswordEmailed')]);
                }

            } else {
                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> Label::Error('SaveRestPasswordCode')]);
            }

        }

//        $this->overWriteLayout('/Client/Layout/layoutNoMenu');

        $this->view->set('token', $option['args']['query']['token']);
        $this->view->set('userEmail', $user->email);
        $this->view->set('requestCode', $code);
        $this->view->set('title', 'Reset Password');
        $this->view->render();
    }

    function generateauthkey() {
        return $this->jsonFormat(['success'=>true,'error'=> false,'message'=>false, 'key'=> md5(Rand::newGuid())]);
    }

    function update() {

        if(!empty(Auth::GetActiveUser(true)->id)) {
            sleep(1);

            $data = $this->getPost();

            $user = T::Find('user', Auth::GetActiveUser(true)->id)->FetchFirstOrDefault();

            if(!$user->IsAny())
                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Oop system could not find record for this user']);

            if(empty($this->getPostKey('authkey')) || !count($data['authkey']) > 30 )
                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Invalid authkey']);

            if(empty($this->getPostKey('name')))
                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'your name is required']);

            if(empty($this->getPostKey('surname')))
                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'your surname is required']);


            $user->name = $this->getPostKey('name');
            $user->surname = $this->getPostKey('surname');
            $user->authKey = $this->getPostKey('authkey');

            if($user->Save())
                return $this->jsonFormat(['success'=>true,'error'=> false, 'message'=> 'Update has been successfully']);
            else
                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Error could not update']);

        }else{
            return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Opp an error occurs ']);
        }
    }


}

?>