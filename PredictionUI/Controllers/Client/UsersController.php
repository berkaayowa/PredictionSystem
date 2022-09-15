<?php
	namespace Controller\Client;
	use BerkaPhp\Controller\BerkaPhpController;
    use BerkaPhp\Helper\Auth;
    use BerkaPhp\Helper\Check;
    use BerkaPhp\Helper\Debug;
    use BerkaPhp\Helper\Rand;
    use BerkaPhp\Helper\SessionHelper;
    use BerkaPhp\HelperRand;
    use BerkaPhp\Helper\RedirectHelper;
    use BerkaPhp\HelperessionHelper;
    use BrkORM\T;
    use Resource\Label;
    use Util\Request;

    class UsersController extends BerkaPhpController
	{

        private $mailer;

		function __construct() {
			parent::__construct();

            $this->mailer = $this->loadComponent("Email");
            $this->view->set('breadcrumb', 'User');
		}

        function index() {
            RedirectHelper::redirect('/users/signin');
        }

		function signin() {

            if($this->is_set($this->getPost())) {

                $user = T::Find('user')
                    ->Where('user.email' , '=', $this->getPost()['Email'])
                    ->Where('user.password' , '=',  md5($this->getPost()['Password']))
                    ->FetchFirstOrDefault();

                if ($user->IsAny()) {

                    if($user->IsVerified == Check::$True && $user->CanLogIn == Check::$True) {

                        if (SessionHelper::exist(Auth::GetDefaultUsername())) {
                            SessionHelper::remove(Auth::GetDefaultUsername());
                        }

                        SessionHelper::add(Auth::GetDefaultUsername(), serialize($user));

                        if (isset($this->getPost()['GoTo'])) {
                            RedirectHelper::redirect($this->getPost()['GoTo']);
                        } else {
                            return $this->jsonFormat(['success'=>true,'error'=> false, 'message'=> "Successfully logged in", 'link'=>'/dashboard']);
                        }
                    } else if($user->IsVerified == Check::$False) {
                        return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> Label::Error('AccountNotActivated')]);
                    } else if($user->CanLogIn == Check::$False) {
                        return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> Label::Error('AccountSuspended')]);
                    }

                } else {
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> Label::Error('InvalidLogin')]);
                }
            }

            $this->overWriteLayout('/Client/Layout/layoutNoMenu');
            $this->view->set('title', 'Sign in');
            $this->view->set('login', true);
            $this->view->render();
		}

        function signup() {

            if($this->is_set($this->getPost())) {

                $user = $this->model->fetchBy(['fields'=>[
                    'Email'=>$this->getPost()['Email']
                ]
                ]);

                if (sizeof($user) == 0) {

                    $data = $this->getPost();
                    $activationCode = md5($this->getPost()['Email'].$this->getPost()['FirstName']);
                    $data['VerificationCode'] = $activationCode;

                    if ($this->model->add($data)) {

                        $this->view->set('activationCode', $activationCode);
                        $this->view->set('firstName', $data['FirstName']);
                        $content = $this->view->renderGetContent('Users/Email/welcome');

                        $isSent = $this->mailer->send(EMAIL_FROM_NAME, "Welcome ".ucfirst($data['FirstName']), "", $content, $this->getPost()['Email']);

                        return $this->jsonFormat(['success'=>true,'error'=> false, 'message'=> false]);
                    } else {
                        return $this->jsonFormat(['error'=> true, 'message'=>'Error could not save this user', 'success'=>false]);
                    }
                } else {
                    return $this->jsonFormat(['error'=> true,'message'=>'This email has been used already', 'success'=>false]);
                }
            } else {
                $this->signin();
            }

        }

        function logout() {
            SessionHelper::remove('user');
            SessionHelper::kill();
            RedirectHelper::redirect('/client/users/signin');
        }

        function activate($params = '') {

            if(is_array($params) && isset($params['params'])) {

                $verificationCode = $params['params'];

                $user = $this->model->fetchWhere(['fields' => [
                    'VerificationCode' => $verificationCode
                ]
                ]);

                if (sizeof($user) == 1) {

                    $user = $user[0];

                    if ($user['IsVerified'] == Check::True()) {

                        $this->view->set('error', true);
                        $this->view->set('verificationMessage', 'This account is activated already. click login on top :)');

                    } else {

                        $isUpdated = $this->model->update([
                            'UserID'=> $user['UserID'],
                            'IsVerified' => Check::True(),
                            'CanLogIn'=> Check::True()
                        ]);

                        if($isUpdated) {
                            $this->view->set('success', true);
                            $this->view->set('verificationMessage', 'Account activated successfully, you can login now , enjoy :) ');
                        } else {
                            $this->view->set('error', true);
                            $this->view->set('verificationMessage', 'Account could not be activated, try again');
                        }
                    }
                }
            } else {
                $this->view->set('error', true);
                $this->view->set('verificationMessage', 'Account could not be found, please signup.');
            }

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

                    $user = $this->model->fetchWhere(['fields'=>
                        [
                            'EmailAddress'=> $data['Email']
                        ]
                    ]);

                    if(sizeof($user) > 0) {

                        $user = $user[0];
                        $resetCode = md5($user['Password'].$user['EmailAddress'].Rand::uniqueDigit(12, 1900));

                        $userData['ResetPasswordCode'] = $resetCode;
                        $userData['UserID'] = $user['UserID'];


                        if($this->is_set($userData)) {
                            if ($this->model->update($userData)) {

                                $this->view->set('userDetails', $user);

                                $body = $this->view->renderGetContent('Email/default', false);
                                $isSent = $this->mailer->send(EMAIL_FROM_NAME, "Reset Password Link", "", $body, $user['EmailAddress']);

                                if($isSent) {
                                    return $this->jsonFormat(['success'=>true,'error'=> false, 'message'=> Label::Success('ResetPasswordEmailed')]);
                                } else{
                                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> Label::Error('ResetPasswordEmailed')]);
                                }

                            } else {
                                return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> Label::Error('SaveRestPasswordCode')]);
                            }
                        }

                    }else {
                        return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> Label::Error('EmailNotFound')]);
                    }

                }
            }

            $this->view->set('title', 'Forgot Password');
            $this->view->render();
        }

        function resetpassword(){
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