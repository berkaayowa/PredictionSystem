<?php
/**
 * Created by PhpStorm.
 * User: f
 * Date: 2018-06-13
 * Time: 6:46 PM
 */

namespace Util;
use BerkaPhp\Helper\Auth;
use BerkaPhp\Helper\Check;
use BerkaPhp\Helper\Rand;
use BrkORM\T;
use Resource\Label;

class Helper {

    public static function TransactionStatus($status){

        $color = '';

        switch($status){
            case CANCELLED:
                $color = 'red';
                break;
            case APPROVED:
                $color = 'green';
                break;
            case PENDING:
                $color = '';
                break;
        }

        return $color;
    }

    public static function IsActive($value){

        $color = 'red';

        switch($value){
            case Check::$True:
                $color = 'green';
                break;
            case Check::$False:
                $color = 'red';
                break;
        }

        return $color;
    }

    public static function IsDeleted($value){

        $color = '';

        switch($value){
            case Check::$True:
                $color = 'red';
                break;

        }

        return $color;
    }

    public static function CheckBox($value){

        $color = Label::General('No');

        switch($value){
            case Check::$True:
                $color = Label::General('Yes');
                break;

        }

        return $color;
    }

    public static function LogError($ex){

    }

    public static function GetCurrentUrl() {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }


    public static function select($id,  $data = array(), $options, $callback = null) {

        $i_select= "<select  id='{$id}' name='{$id}' ";
        $i_option = '';
        $selected = isset($options['selected']) ? $options['selected'] : '';

        $length = sizeof($data);
        $option_length = sizeof($options);

        if($option_length > 0) {

            foreach($options as $_option => $values) {
                if($_option != 'selected' && $_option != 'value' && $_option != 'text' ) {
                    $i_select.=" {$_option} ='{$values}''";
                }
            }

        }

        if($length > 0) {

            foreach($data as $data_option) {

                $sel = '';

                $data_option = (array) $data_option;

                if($selected == $data_option[$options['value']])
                {
                    $sel = 'selected';
                }
                if($callback == null)
                    $i_option.='<option '.$sel.' value ='.$data_option[$options['value']].'>'.$data_option[$options['text']].'</option>';
                else
                    $i_option.='<option '.$sel.' value ='.$data_option[$options['value']].'>'.(call_user_func($callback, $data_option)).'</option>';
            }

        } else {
            $i_option.='<option></option>';
        }

        return $i_select.'>'.$i_option.'</select>';
    }

    public static function GetCurrentDomainUrl() {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    }


    public static  function CreateUserCredentials($user, $emailCredentials = false, $count = 0) {

        $returnData = [
            'userId'=>0,
            'message'=>""
        ];

        $userName = "";

        $role = T::Find('user_role')
            ->Where('ID', '=', $user->RefRoleID)
            ->FetchFirstOrDefault();

        $companyCode = Auth::GetActiveUser(true)->company->Code;

        $roleCode = $role->Code;

        if($count == 0)
            $userName =  strtolower($user->FirstName).'.'.strtolower($companyCode).'.'.strtolower($roleCode);
        if($count == 1)
            $userName =  strtolower($user->LastName).'.'.strtolower($companyCode).'.'.strtolower($roleCode);
        if($count == 2)
            $userName =  strtolower($user->FirstName.$user->LastName).'.'.strtolower($companyCode).'.'.strtolower($roleCode);
        if($count == 3)
            $userName =  strtolower($user->LastName.$user->FirstName).'.'.strtolower($companyCode).'.'.strtolower($roleCode);
        if($count > 3)
            $userName =  strtolower($user->LastName).'.'.strtolower($companyCode).'.'.strtolower($roleCode).".".$count;

        $password = $userName .'@'.Rand::uniqueDigit(10, 10000);

        $checkUser = T::Find('user')
            ->Where('Username', '=', $userName)
            ->Where('IsDeleted', '=', Check::$False)
            ->Where('RefGroupUserID', '=', Auth::GetActiveUser()->RefGroupUserID)
            ->FetchFirstOrDefault();

        if($checkUser->IsAny()) {
            $count++;
            self::CreateUserCredentials($user, $emailCredentials, $count);
        }
        else
        {
            $user->Username = $userName;
            $user->Password = md5($password);

            if ($user->Save()) {

                if($emailCredentials) {

                    $message = Label::EmailMessage('NewAccount');

                    $message = str_replace("{name}", ucfirst($user->FirstName), $message);
                    $message = str_replace("{surname}", ucfirst($user->LastName), $message);
                    $message = str_replace("{username}", $user->Username, $message);
                    $message = str_replace("{password}", $password, $message);
                    $message = str_replace("{company}", \BerkaPhp\Helper\Auth::GetActiveUser(true)->company->RegistrationName, $message);
                    $message = str_replace("{link}", Helper::GetCurrentDomainUrl(), $message);

                    $process = T::Create('process');
                    $process->typeCode = PROCESS_EMAIL;
                    $process->destination = $user->EmailAddress;
                    $process->content = $message;
                    $process->subject = Label::General('Welcome')." " .ucfirst($user->FirstName);
                    $process->mFrom = \BerkaPhp\Helper\Auth::GetActiveUser(true)->company->RegistrationName;
                    $process->refGroupUserId = \BerkaPhp\Helper\Auth::GetActiveUser(true)->RefGroupUserID;
                    $process->Save();
                }

                return true;

            }
            else
            {
                return false;
            }


        }
    }

    public static function CreateUser($name, $surname, $roleId, $statusId, $data, $emailCredentials = false, $createLoginCredentials = false, $count = 0) {

        $returnData = [
            'userId'=>0,
            'message'=>""
        ];

        $userName = "";

        $role = T::Find('user_role')
            ->Where('ID', '=', $roleId)
            ->FetchFirstOrDefault();

        $companyCode = Auth::GetActiveUser(true)->company->Code;

        $roleCode = $role->Code;

        if($count == 0)
            $userName =  strtolower($name).'.'.strtolower($companyCode).'.'.strtolower($roleCode);
        if($count == 1)
            $userName =  strtolower($surname).'.'.strtolower($companyCode).'.'.strtolower($roleCode);
        if($count == 2)
            $userName =  strtolower($name.$surname).'.'.strtolower($companyCode).'.'.strtolower($roleCode);
        if($count == 3)
            $userName =  strtolower($surname.$name).'.'.strtolower($companyCode).'.'.strtolower($roleCode);
        if($count > 3)
            $userName =  strtolower($surname.$name).'.'.strtolower($companyCode).'.'.strtolower($roleCode).".".$count;

        $password = $userName .'@'.Rand::uniqueDigit(10, 10000);

        if($createLoginCredentials) {

            $user = T::Find('user')
                ->Where('Username', '=', $userName)
                ->Where('IsDeleted', '=', Check::$False)
                ->Where('RefGroupUserID', '=', Auth::GetActiveUser()->RefGroupUserID)
                ->FetchFirstOrDefault();

            if($user->IsAny()) {
                $count++;
                self::CreateUser($name, $surname, $roleId, $statusId, $data, $emailCredentials, $createLoginCredentials, $count);
            }
            else
            {
                $user = T::Create('user');
                $user->SetProperties($data);
                $user->FirstName = strtolower($data['FirstName']);
                $user->LastName = strtolower($data['LastName']);
                $user->EmailAddress = strtolower($data['EmailAddress']);
                $user->Username = $userName;
                $user->Password = md5($password);

                $user->IsVerified = Check::$True;
                $user->CanLogIn = Check::$True;
                $user->RefGroupUserID = Auth::GetActiveUser()->RefGroupUserID;
                //condition
                $user->RefBranchID = Auth::GetActiveUser(true)->RefBranchID;
                $user->CreatedBy = Auth::GetActiveUser(true)->UserID;

                $status = T::Find('user_status')
                    ->Where('UserStatusID', '=', $statusId)
                    ->FetchFirstOrDefault();

                $user->RefUserStatusID = $status->UserStatusID;
                $user->RefRoleID = $role->ID;


                if ($user->Save()) {

                    if($emailCredentials) {

                        $message = Label::EmailMessage('NewAccount');

                        $message = str_replace("{name}", ucfirst($user->FirstName), $message);
                        $message = str_replace("{surname}", ucfirst($user->LastName), $message);
                        $message = str_replace("{username}", $user->Username, $message);
                        $message = str_replace("{password}", $password, $message);
                        $message = str_replace("{company}", \BerkaPhp\Helper\Auth::GetActiveUser(true)->company->RegistrationName, $message);
                        $message = str_replace("{link}", Helper::GetCurrentDomainUrl(), $message);

                        $process = T::Create('process');
                        $process->typeCode = PROCESS_EMAIL;
                        $process->destination = $user->EmailAddress;
                        $process->content = $message;
                        $process->subject = Label::General('Welcome')." " .ucfirst($user->FirstName);
                        $process->mFrom = \BerkaPhp\Helper\Auth::GetActiveUser(true)->company->RegistrationName;
                        $process->refGroupUserId = \BerkaPhp\Helper\Auth::GetActiveUser(true)->RefGroupUserID;
                        $process->Save();
                    }

                    $returnData['userId'] = $user->UserID;
                    $returnData['message'] = Label::Success('Saving');

                    return $returnData;

                }
                else
                {
                    $returnData['message'] = Label::Error('Saving');
                    return $returnData;
                }


            }

        }
        else {

            $user = T::Find('user')
                ->Where('FirstName', '=', strtolower($data['FirstName']))
                ->Where('LastName', '=', strtolower($data['LastName']))
                ->Where('IsDeleted', '=', Check::$False)
                ->Where('RefGroupUserID', '=', Auth::GetActiveUser()->RefGroupUserID)
                ->FetchFirstOrDefault();

            if($user->IsAny()) {

                $returnData['message'] = Label::Error('UserExistCheckOnName');
                return $returnData;
            }

            $user = T::Create('user');
            $user->SetProperties($data);
            $user->FirstName = strtolower($data['FirstName']);
            $user->LastName = strtolower($data['LastName']);
            $user->EmailAddress = strtolower($data['EmailAddress']);
            //$user->Username = $userName;
            //$user->Password = md5($password);

            //$user->IsVerified = Check::$True;
           // $user->CanLogIn = Check::$True;
            $user->RefGroupUserID = Auth::GetActiveUser()->RefGroupUserID;
            //condition
            $user->RefBranchID = Auth::GetActiveUser(true)->RefBranchID;
            $user->CreatedBy = Auth::GetActiveUser(true)->UserID;


            $status = T::Find('user_status')
                ->Where('UserStatusID', '=', $statusId)
                ->FetchFirstOrDefault();

            $user->RefUserStatusID = $status->UserStatusID;
            $user->RefRoleID = $role->ID;


            if ($user->Save()) {

                if($emailCredentials) {

                    $message = "Hi, Username : {$userName} <br> Password: {$password}";
                    $process = T::Create('process');
                    $process->typeCode = PROCESS_EMAIL;
                    $process->destination = $user->EmailAddress;
                    $process->content = $message;
                    $process->subject = "Welcome ";
                    $process->mFrom = \BerkaPhp\Helper\Auth::GetActiveUser(true)->company->RegistrationName;
                    $process->Save();
                }

                $returnData['userId'] = $user->UserID;
                $returnData['message'] = Label::Success('Saving');

                return $returnData;

            }
            else
            {
                $returnData['message'] = Label::Error('Saving');
                return $returnData;
            }
        }

    }

    public static function Currency($value) {
        return number_format($value, 2);
    }

    public static function SendSMS($body = array()) {

//        $data = array(
//            'message'=>$body['message'],
//            'recipients'=>[
//                ['mobileNumber'=>$body['to']]
//            ],
//            "maxSegments"=> 6
//        );
//        $data_json = json_encode($data);
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, "https://www.winsms.co.za/api/rest/v1/sms/outgoing/send");
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'AUTHORIZATION: 61030DB5-52C3-4834-94AF-42FCC5AF1E2E'));
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//
//        $response  = curl_exec($ch);
//        $response = json_decode($response);
//        $erro = curl_error($ch);
//        curl_close($ch);

        $response = SMS::Send($body['to'], $body['message']);

        return $response != null;

    }

    public static function DaysAgo($days) {
        return date('Y-m-d', strtotime('-'.$days. ' days'));
    }

    public static function GetMode($name = '') {
        if(empty($name)) {
            if(array_key_exists("mode", $_GET))
                return $_GET['mode'];
        }

        return '';
    }

    public static function DisabledOnRole($roles = array()) {
       return in_array(Auth::GetActiveUser()->role->Code, $roles) ? 'disabled' : '';

    }

    public static function IsRole($roles = array()) {
        return in_array(Auth::GetActiveUser()->role->Code, $roles);
    }

    public static function Last6Months() {
        $dates = [];
        for ($j = 0; $j <= 5; $j++) {
            $date = date("01-m-Y", strtotime(" -$j month"));
            array_push($dates, ['startDate'=>$date, 'endDate'=>date("t-m-Y", strtotime($date))]);
        }

        return $dates;
    }

    public static function Last12Months() {
        $dates = [];
        for ($j = 0; $j <= 11; $j++) {
            $date = date("01-m-Y", strtotime(" -$j month"));
            array_push($dates, ['startDate'=>$date, 'endDate'=>date("t-m-Y", strtotime($date))]);
        }

        return $dates;
    }

    public static function FileExist($path) {
        $val = file_exists($path);
        return $val;
    }

    public static function GetFileContent($path) {

        $contents = "";

        if(self::FileExist($path)) {

            $f = fopen($path, 'r');
            if ($f) {
                $contents = fread($f, filesize($path));
                fclose($f);
            }
        }

        return $contents;
    }

    public static function GetPredictionBg($percentage) {

        if($percentage > 80 && $percentage < 95)
            return "bg-low-risk";

        else if($percentage > 94 && $percentage < 115)
            return "bg-safe";

        else if($percentage > 114)
            return "bg-no-risk";

        return "";
    }

    public static function GetPredictionToBorder($percentage) {

        if($percentage > 80 && $percentage < 95)
            return "p-low-risk";

        else if($percentage > 94 && $percentage < 115)
            return "p-safe";

        else if($percentage > 114)
            return "p-no-risk";

        return "";
    }

    public static function GetPredictionHint($percentage) {

        if($percentage > 80 && $percentage < 95)
            return "Very risk";

        else if($percentage > 94 && $percentage < 115)
            return "risk";

        else if($percentage > 114)
            return "safe";

        return "";
    }

    public static function GetPredictionLabel($homeTeam, $awayTeam, $label) {

        $max = 30;

        if(strpos($homeTeam, 'oper'))
        {
            $t = strpos($label, $homeTeam);
            $tx = strpos($label, $homeTeam) >= 0;
        }


        if(strlen($label) > $max) {

            if(strpos($label, $homeTeam) !== false) {
                $label = str_replace($homeTeam, "", $label );
                $label =  substr($homeTeam, 0, 8) . '..' .$label;
            }
            else if(strpos($label, $awayTeam) !== false) {
                $label = str_replace($awayTeam, "", $label );
                $label =  substr($awayTeam, 0, 8) . '..' .$label;
            }
        }

        return $label;
    }

    public static function DisplayLabel($maxChar, $label) {

        if(strlen($label) > $maxChar)
            return substr($label,0, $maxChar) . '...';

        return $label;
    }

    public static function CheckPrediction($homeTeam, $awayTeam, $prediction) {

        $label  = $prediction;

        if(!property_exists($homeTeam, 'Score') || !property_exists($awayTeam, 'Score'))
            return false;

        if(strpos($label, $homeTeam->TeamName) !== false) {

            $label = str_replace($homeTeam->TeamName, "", $label );

            if (strpos($label, "Win/Draw") !== false)
                return $homeTeam->Score >= $awayTeam->Score;
            else if (strpos($label, "Win") !== false)
                return $homeTeam->Score > $awayTeam->Score;
            else if (strpos($label, "Draw") !== false)
                return $homeTeam->Score == $awayTeam->Score;

        }
        else if(strpos($label, $awayTeam->TeamName) !== false) {

            $label = str_replace($awayTeam->TeamName, "", $label );

            if (strpos($label, "Win/Draw") !== false)
                return $homeTeam->Score <= $awayTeam->Score;
            else if (strpos($label, "Win") !== false)
                return $homeTeam->Score < $awayTeam->Score;
            else if (strpos($label, "Draw") !== false)
                return $homeTeam->Score == $awayTeam->Score;
        }

        return false;

    }





} 