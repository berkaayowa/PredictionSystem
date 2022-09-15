<?php
namespace payment;
use BerkaPhp\Controller\component\PaymentGataway;
use BerkaPhp\Helper\Auth;
use BerkaPhp\HelperCurrency;

class PayPal extends PaymentGataway {

    private $merchandiseDetails;
    private $customerDetails;
    private $transactionDetails;
    private $requestUrl;

    function __construct() {

        $this->merchandiseDetails = [
            'business' => PAYPAL_BUSINESS,
            'cmd' => '_xclick',
            'cbt'=>'Return to The Store',
            'notify_url'=> PAYMENT_NOTIFICATION_URL,
            'return' => PAYMENT_SUCCESS_URL,
            'cancel_return' => PAYMENT_ERROR_URL
        ];

        $this->transactionDetails = array();
        $this->customerDetails = array();

    }

    public function setCustomerDetail($details = array()) {

        if(sizeof($details) > 0) {
            $this->customerDetails = $details;
        }

    }

    public function setTransactionDetail($details) {

        if(is_array($details)) {

            $this->transactionDetails = [
                'amount' => round(Currency::Init($details['OrderTotalAmountDue'])->convert()['convertedAmount'],2),
                'item_name' => 'Order Number: '.$details['OrderCode'],
                'currency_code' => Currency::Init()->getCurrentCurrency(),
                'quantity' => '1',
                'custom' => $details['OrderCode']
            ];

            $this->merchandiseDetails['notify_url'].='/'.md5($details['OrderCode']).'/?order_id='.$details['OrderCode'];
            $this->merchandiseDetails['return'].='/'.md5($details['OrderCode']).'/?order_id='.$details['OrderCode'];
        }

    }

    public function generate() {

        if(sizeof($this->customerDetails) > 0) {
            $this->customerDetails = [
                'first_name' => Auth::GetActiveUser(true, 'FirstName'),
                'last_name'  => Auth::GetActiveUser(true, 'LastName'),
                'email'=> EMAIL_NOTICE
            ];
        }

        $paymentDetails = array_merge($this->merchandiseDetails, $this->customerDetails, $this->transactionDetails);

        return $paymentDetails;

    }

    public function getRequestLink()
    {
        return PAYPAL_POST_URL;
    }
}

?>