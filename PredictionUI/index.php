<?php

    if($_SERVER['SERVER_NAME'] ==  'soccerprediction.co.za' )
        error_reporting(E_ERROR | E_PARSE);

    session_start();
    date_default_timezone_set('Africa/Johannesburg');
    require_once('AutoLoader.php');
    BerkaPhp\Helper\SessionHelper::start();
    require_once("Config/Config.php");
    require_once("BerkaPhp/Router/Router.php");


?>
