<?php
namespace Controller;
use BerkaPhp\Controller\BerkaPhpController;
use BerkaPhp\Helper\Auth;



class RestfulApiController extends BerkaPhpController
{
    function __construct() {
        parent::__construct(false);
    }

    function response($data, $code = 201) {
        //header('Content-type: application/json', true, $code);
        return $this->jsonFormat($data);
    }

    function email() {
        return $this->LoadComponent('Email');
    }


}

?>