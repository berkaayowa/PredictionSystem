<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 7/24/2022
 * Time: 11:03 PM
 */

require_once('AutoLoader.php');
require_once("Config/Config.php");

$option = [
    'args' => [
        'query'=>[
            'code'=>'run'
        ]
    ]
];

$msg = new \Util\Message();

while(true) {

    $msg->Process($option);
    $msg->Reply($option);

    sleep(15);

}


?>