<?php
	namespace Controller\Client;
    use BerkaPhp\Controller\BerkaPhpController;
    use BerkaPhp\Helper\Auth;
    use BerkaPhp\Helper\Debug;
    use BrkORM\T;

    class PaymentController extends BerkaPhpController
	{

		function __construct() {
			parent::__construct();
		}

		function index() {

            $this->view->render();
		}

        function cancel($option) {

			 if(isset($option['args'])) {

                $encrypedId = $option['args']['params'][0];
                $id = $option['args']['query']['order_id'];

                if($encrypedId == md5($id)) {

                    $order = T::Find('purchase', $id)->FetchFirstOrDefault();

                    if($order->IsAny()) {
                        $status = T::Find('status')
                            ->Where('code', '=', 'CNL')
                            ->FetchFirstOrDefault();

                        $order->refStatusId = $status->id;

                        if(!$order->Save()) {
                            $message = 'Error happen the system could not update order status(CNL) :'.$id.' <br> notification url : '.$_SERVER['REQUEST_URI'];
                            $this->LoadComponent('Email')->initialize()->send(EMAIL_FROM_NAME,'Successfully order but could not update status', '', $message, EMAIL_CONTACT);
                        }
                    }

                }
			}
			
            $this->view->render();

        }

        function notice($option) {

            if(isset($option['args'])) {

                $encrypedId = $option['args']['params'][0];
                $id = $option['args']['query']['order_id'];

                if($encrypedId == md5($id)) {

                    $order = T::Find('purchase', $id)
                        ->Join('user', 'user.id = purchase.refUserId')
                        ->FetchFirstOrDefault();

                    if(!$order->IsAny()) {
                        $message = 'Error happen the system could not find this order id :'.$id.' <br> notification url : '.$_SERVER['REQUEST_URI'];
                        $this->LoadComponent('Email')->initialize()->send(EMAIL_FROM_NAME,'Error Successfully order but could not be found', '', $message, EMAIL_CONTACT);
                    } else {

                        $status = T::Find('status')
                            ->Where('code', '=', 'PCG')
                            ->FetchFirstOrDefault();

                        $currentId = $order->refStatusId;
                        $order->refStatusId = $status->id;

                        if(!$order->Save()) {
                            $message = 'Error happen the system could not update order status(SCS) order id :'.$id.' <br>form '.$currentId.' to status id ='.$status->id.' <br> notification url : '.$_SERVER['REQUEST_URI'];
                            $this->LoadComponent('Email')->initialize()->send(EMAIL_FROM_NAME,'Successfully order but could not update status', '', $message, EMAIL_CONTACT);
                        }else {

                            $user = T::Find('user', $order->user->id)
                                ->FetchFirstOrDefault();

                            $user->balance = (int) $user->balance + $order->credits;

                            if(!$user->Save()) {
                                $message = 'Error happen the system could not update oder id'.$order->id.' url : '.$_SERVER['REQUEST_URI'];
                                $this->LoadComponent('Email')->initialize()->send(EMAIL_FROM_NAME,'error update user balance', '', $message, EMAIL_CONTACT);
                            }else {

                                $message = "Dear " . ucfirst($order->user->name) . ' ' . ucfirst($order->user->surname) .' <br><br>Your payment for order number #'.$order->id.' has been successfully received
                             and <strong>'.$order->credits.' SMS credit/s has been loaded to your account.<br><br> Your current SMS balance is '.$user->balance.' SMS/s </strong> '
                                    . '</strong>. <br><br> <a href="'.SITE_URL.'">Click here </a> to log onto the portal.';

                                $this->view->set('emailContent', $message);
                                $content = $this->view->renderGetContent('Views/Email/default');
                                $isSent = $this->LoadComponent('Email')->initialize()->send(EMAIL_FROM_NAME,'Payment confirmation order #'.$order->id, '',$content, $user->email);

                                $this->LoadComponent('Email')->initialize()->send(EMAIL_FROM_NAME,'Support payment confirmation order #'.$order->id, '',$content, EMAIL_SUPPORT);

                            }

                        }

                    }

                }

            }

        }

        function success($option) {

            if(isset($option['args'])) {

                $encrypedId = $option['args']['params'][0];
                $id = $option['args']['query']['order_id'];

                if($encrypedId == md5($id)) {

                    $order = T::Find('purchase', $id)->FetchFirstOrDefault();

                    if(!$order->IsAny()) {
                        $message = 'Error happen the system could not find this order id :'.$id.' <br> success url : '.$_SERVER['REQUEST_URI'];
                        $this->LoadComponent('Email')->initialize()->send(EMAIL_FROM_NAME,'Successfully order but could not be found', '', $message, EMAIL_CONTACT);
                    } else {

                        $status = T::Find('status')
                            ->Where('code', '=', 'SCS')
                            ->FetchFirstOrDefault();

                        $order->refStatusId = $status->id;

                        if(!$order->Save()) {
                            $message = 'Error happen the system could not update order status(PNC) :'.$id.' <br> success url : '.$_SERVER['REQUEST_URI'];
                            $this->LoadComponent('Email')->initialize()->send(EMAIL_FROM_NAME,'Support payment confirmation order #'.$order->id, '',"Could not update order to success status ", EMAIL_CONTACT);
                        }

                    }

                }

            }

            $this->view->render();
        }

	}

?>