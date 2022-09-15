<?php
namespace Controller\Framework;
use BerkaPhp\Controller\BerkaPhpController;
use BerkaPhp\Helper\Debug;

class PageController extends BerkaPhpController
{

    function __construct() {
        parent::__construct(false);
    }

    /* Display all users from database
    *  Client action in this controller
    *  @author berkaPhp
    */

    function index() {

        $this->view->render($param = null);

    }

    function actionnotfound($param = null) {

        $this->view->set('details', $param['args']['query']);
        $this->view->render();

    }

    function controllernotfound($param = null) {

        $this->view->set('details', $param['args']['query']);
        $this->view->render();

    }



    function onResourceReady($resource)
    {
        return $resource;
    }


}

?>