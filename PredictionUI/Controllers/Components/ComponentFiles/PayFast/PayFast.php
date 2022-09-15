<?php
namespace Payment;

use BerkaPhp\Controller\component\PaymentGataway;
use BerkaPhp\Helper\Auth;

class PayFast extends PaymentGataway {

    private $merchandiseDetails;
    private $customerDetails;
    private $transactionDetails;
    private $requestUrl;

    function __construct() {

        $this->merchandiseDetails = [
            'merchant_id' => PAYFAST_MERCHANT_ID,
            'merchant_key' => PAYFAST_MERCHANT_KEY,
            'return_url' => PAYMENT_SUCCESS_URL,
            'cancel_url' => PAYMENT_ERROR_URL,
            'notify_url' => PAYMENT_NOTIFICATION_URL
        ];

        $this->transactionDetails = array();
        $this->customerDetails = array();

    }

    public function setCustomerDetail($details) {

        if(is_array($details)) {
            $this->customerDetails = $details;
        }
    }

    public function setTransactionDetail($details) {

        if(is_array($details)) {

            $this->transactionDetails = [
                'm_payment_id' => $details['OrderCode'],
                'amount' => round($details['OrderTotalAmountDue'], 2 ),
                'item_name' => 'Order Number: '.$details['OrderCode'],
                'item_description' => 'Item Description',
                'custom_int1' => (int)$details['OrderCode'], //custom integer to be passed through
                'custom_str1' => $details['OrderCode'],

            ];

            $this->merchandiseDetails['return_url'].='/'.md5($details['OrderCode']).'?order_id='.$details['OrderCode'];
            $this->merchandiseDetails['cancel_url'].='/'.md5($details['OrderCode']).'?order_id='.$details['OrderCode'];
            $this->merchandiseDetails['notify_url'].='/'.md5($details['OrderCode']).'?order_id='.$details['OrderCode'];
        }

    }

    public function generate() {

        if(sizeof($this->customerDetails) == 0) {
            $this->customerDetails = [
                'name_first' => Auth::GetActiveUser(true, 'FirstName'),
                'name_last'  => Auth::GetActiveUser(true, 'LastName'),
                'email_address'=> Auth::GetActiveUser(true, 'Email')
            ];
        }

        $pfOutput = "";
        $paymentDetails = array_merge($this->merchandiseDetails, $this->customerDetails, $this->transactionDetails);

        foreach($paymentDetails as $key => $val )
        {
            if(!empty($val))
            {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }

        $getString = substr($pfOutput, 0, -1 );

        $paymentDetails['signature'] = md5( $getString );

//        var_dump($getString);
//        var_dump($paymentDetails);

        return $paymentDetails;

    }

    public function getRequestLink()
    {
        return PAYFAST_POST_URL;
    }
}

?>