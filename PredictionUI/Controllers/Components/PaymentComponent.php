<?php
/**
 * Created by PhpStorm.
 * User: berka
 * Date: 2017/11/30
 * Time: 20:10
 */

namespace Controller\Component;

use BerkaPhp\Controller\component\PaymentGataway;

class PaymentComponent extends PaymentGataway
{
    private $paymentGetaway;
    private $paymentGetawayName;

    function __construct()
    {

    }

    function initialize($name) {

        $getaway = "Payment\\".$name;
        $this->paymentGetaway = new $getaway();
        $this->paymentGetawayName;
    }

    public function getPaymentGetawayName()
    {
        return $this->paymentGetawayName;
    }


    public function setCustomerDetail($detail)
    {
        $this->paymentGetaway->setCustomerDetail($detail);
    }

    public function setTransactionDetail($detail)
    {
        $this->paymentGetaway->setTransactionDetail($detail);
    }

    public function generate()
    {
        return $this->paymentGetaway->generate();
    }

    public function getRequestLink()
    {
        return  $this->paymentGetaway->getRequestLink();
    }
}



