<?php
/**
 * Created by PhpStorm.
 * User: f
 * Date: 2018-08-13
 * Time: 8:45 PM
 */

namespace Util;


class SMS {

    public static  function Send($number, $message)
    {
        $data = array(
            'message'=>$message,
            'recipients'=>[
                ['mobileNumber'=>$number]
            ],
            "maxSegments"=> 6
        );
        $data_json = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, SMS_SEND_URL);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'AUTHORIZATION: '.SMS_API_KEY));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        $response = json_decode($response);
        curl_close($ch);

        return $response;
    }
} 