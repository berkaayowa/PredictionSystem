<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 1/30/2022
 * Time: 11:27 PM
 */

namespace Util;


use BerkaPhp\Helper\Auth;
use BerkaPhp\Helper\Check;
use BrkORM\T;

class ISendHelper {

    public static function GetMessageDestination($message){

        if($message->type->code == 'SMS' || $message->type->code =='SMSRP')
            return $message->contact->cellPhone;
        if($message->type->code == 'EMAIL')
            return $message->contact->emailAddress;

    }

    public static function LogMessage($messageId, $logMessage){

        $log = T::Create('log');
        $log->messageId = $messageId;
        $log->logMessage = $logMessage;
        $log->Save();

    }

    public static function GetReplies(){

        $message = T::Find('message')
            ->Join(['message_status'=>'status'], 'status.messageStatusId = message.messageStatusId', 'LEFT JOIN')
            ->Join('contact', 'contact.contactId = message.contactId')
            ->Join(['message_type'=>'type'], 'type.messageTypeId = message.messageTypeId', 'LEFT JOIN')
            ->Where('message.userId', '=', Auth::GetActiveUser(false)->id)
            ->Where('type.code', '=', 'SMSRP')
            ->Where('message.isViewed', '=', Check::$False)
            ->FetchFirstOrDefault();

    }

    public static function ReplaceParameter($message){

        $value = $message->contentTemplate;

        $value = str_replace("{{name}}",$message->contact->name, $value);
        $value = str_replace("{{surname}}",$message->contact->surname, $value);
        $value = str_replace("{{emailAddress}}",$message->contact->emailAddress, $value);
        $value = str_replace("{{cellPhone}}",$message->contact->cellPhone, $value);

        return $value;

    }

} 