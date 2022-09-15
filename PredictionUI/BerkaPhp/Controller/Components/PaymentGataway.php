<?php
namespace berkaPhp\controller\component;

abstract class PaymentGataway {

    abstract public function setCustomerDetail($detail);
    abstract public function setTransactionDetail($detail);
    abstract public function getRequestLink();
    abstract public function generate();

}
?>