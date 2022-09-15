<?php
	namespace Controller\Client;
    use BerkaPhp\Controller\BerkaPhpController;
    use BerkaPhp\Helper\Auth;
    use BerkaPhp\Helper\Check;
    use BerkaPhp\Helper\Debug;
    use BerkaPhp\Helper\Rand;
    use BrkORM\T;

    class CreditsController extends BerkaPhpController
	{

		function __construct() {
			parent::__construct();
		}

		function index() {

            $this->view->render();
		}

        function buycredit() {

            $methods = T::Find('payment_method')
                ->FetchList();
            $prices = T::Find('price')
                ->Where('isDeleted', '=', Check::$False)
                ->FetchList();

            $this->view->set('methods', $methods);
            $this->view->set('prices', $prices);
            $this->view->render();
        }

        function purchases() {
            $purchases = T::Find('purchase')
                ->Join('status', 'status.id = purchase.refStatusId')
                ->Join(['payment_method'=>'method'], 'method.id = purchase.refPaymentMethodId')
                ->Where('purchase.refUserId', '=', Auth::GetActiveUser(false)->id)
                ->OrderBy('purchase.id', 'DESC')
                ->FetchList();
            $this->view->set('purchases', $purchases);
            $this->view->render();
        }

        function checkout($option) {

            $order =T::Find('purchase')
                ->Join('status', 'status.id = purchase.refStatusId')
                ->Join(['payment_method'=>'method'], 'method.id = purchase.refPaymentMethodId')
                ->Where('purchase.id', '=', $option['args']['params'][0])
                ->Where('purchase.refUserId', '=', Auth::GetActiveUser(false)->id)
                ->FetchFirstOrDefault();

            $paymentGateAway = $this->LoadComponent('Payment');
            $paymentGateAway->initialize('PayFast');
            $paymentGateAway->setCustomerDetail([
                    'name_first' => Auth::GetActiveUser(false)->name,
                    'name_last'  => Auth::GetActiveUser(false)->surname,
                    'email_address'=> Auth::GetActiveUser(false)->email
                ]);
            $paymentGateAway->setTransactionDetail([
                    'OrderCode' => $order->id,
                    'OrderTotalAmountDue' => $order->amount,
                ]);


            $inputs = $paymentGateAway->generate();
            $link = $paymentGateAway->getRequestLink();

            $this->view->set('inputs', $inputs);
            $this->view->set('link', $link);
            $this->view->set('order', $order);

            $this->view->render();
        }

        function placeorder() {
            if($this->is_set($this->getPost())) {

                $quantity = (int) $this->getPostKey('Quantity');

                if(empty($this->getPostKey('PaymentMethod')))
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Please select a payment method']);

                if($quantity > 15) {

                    $status = T::Find('status')
                        ->Where('code','=', 'PNP')
                        ->FetchFirstOrDefault();

                    $status = T::Find('status')
                        ->Where('code','=', 'PNP')
                        ->FetchFirstOrDefault();

                    if(!$status->IsAny())
                        return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Oop the system could not found correct status for your order']);

                    $price = T::Find('price')
                        ->Where('end', '>', $quantity)
                        ->Where('isDeleted', '=', Check::$False)
                        ->OrderBy('start', 'ASC')
                        ->FetchFirstOrDefault();

                    if(!$price->IsAny())
                        return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Oop the system could not found price range for the give quantity']);

                    $totalAmount = (($quantity * $price->price) * 0.15) + ($quantity * $price->price);

                    $purchase = T::Create('purchase');
                    $purchase->amount = $totalAmount;
                    $purchase->refUserId = Auth::GetActiveUser(false)->id;
                    $purchase->refStatusId = $status->id;
                    $purchase->totalTax = (($quantity * $price->price) * 0.15);
                    $purchase->refPaymentMethodId = $this->getPostKey('PaymentMethod');
                    $purchase->credits = $quantity;
                    $purchase->pricePerUnit = $price->price;
                    $purchase->uniqueId = Rand::newGuid();

                    if($purchase->Save()){
                        $order =T::Find('purchase', $purchase->id)
                            ->Join('status', 'status.id = purchase.refStatusId')
                            ->Join(['payment_method'=>'method'], 'method.id = purchase.refPaymentMethodId')
                            ->FetchFirstOrDefault();

                        $this->view->set('order', $order);

                        $content = $this->view->renderGetContent('Views/Email/orderConfirmation');

                        $isSent = $this->LoadComponent('Email')->initialize()->send('Softclicktech.com','Sms order confirmation #'.$order->id, '',$content, Auth::GetActiveUser(false)->email);

                        $paymentMethod = T::Find('payment_method', $purchase->refPaymentMethodId)->FetchFirstOrDefault();

                        $url = '/credits/checkout/'.$purchase->id;

                        if(isset($paymentMethod->code) && $paymentMethod->code == 'DPS' )
                            $url = '/credits/notification/'.$purchase->id;

                        sleep(1);
                        return $this->jsonFormat(['success'=>true,'error'=> false, 'message'=> 'Successfully placed order', 'link'=>\BerkaPhp\Helper\Html::action($url)]);
                    }else {
                        return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'Oop error, system could not save your order, contact support.']);
                    }

                }else {
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> 'You can not buy less than 15 SMSs']);
                }

            }
        }

        function calculateprice() {
            if($this->is_set($this->getPost())) {

                $quantity = (int) $this->getPostKey('Quantity');

                $matchPriceRange = null;

                if($quantity > 0) {

                    $prices = T::Find('price')
                        ->Where('end', '>', $quantity)
                        ->Where('isDeleted', '=', Check::$False)
                        ->OrderBy('start', 'ASC')
                        ->FetchFirstOrDefault();

                    $this->view->set('quantity', $quantity);
                    $this->view->set('price', $prices);
                    $content = $this->view->renderGetContent();
                    sleep(1);
                    return $this->jsonFormat(['success'=>true,'error'=> false, 'message'=> false, 'content'=>$content]);

                }

            }
        }

        function notification($option) {

            $order =T::Find('purchase')
                ->Join('status', 'status.id = purchase.refStatusId')
                ->Join(['payment_method'=>'method'], 'method.id = purchase.refPaymentMethodId')
                ->Where('purchase.id', '=', $option['args']['params'][0])
                ->Where('purchase.refUserId', '=', Auth::GetActiveUser(false)->id)
                ->FetchFirstOrDefault();

            $this->view->set('order', $order);
            $this->view->render();

        }

        function pricing($option) {

            $prices = T::Find('price')
                ->Where('isDeleted', '=', Check::$False)
                ->FetchList();

            $this->view->set('prices', $prices);
            $this->view->render();

        }


	}

?>