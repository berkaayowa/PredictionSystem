<?php
namespace berkaPhp\config;

use BerkaPhp\Database\DB;
use BrkORM\BrkORMDatabase;

define('DEBUG', false, true);
define('LIVE_TEST', true, true);
define('SYS_NAME', 'Free Daily Soccer | Tips | Predictions | Soccer Live Score, Latest Results' , true);
define('DATE_FORMAT', 'Y-m-d h:m:s' , true);
define('DATE_SECOND_FORMAT', 'd-m-Y h:m' , true);
define('DATE_THIRD_FORMAT', 'd-m-Y' , true);
define('DB_DATE_FORMAT', 'Y-m-d' , true);
define('DATE_NOW', date(DATE_FORMAT) , true);
define('LIVE_SITE', 'soccerprediction.co.za' , true);
define('QA_SITE', 'qa.soccerprediction.co.za' , true);
define('SYSTEM_USER', 'system' , true);

define('IS_LIVE_SITE', ($_SERVER['SERVER_NAME'] ==  LIVE_SITE || $_SERVER['SERVER_NAME'] ==  QA_SITE), true);

//Database settings

switch ($_SERVER['SERVER_NAME']) {
    case "qa.soccerprediction.co.za" :
    case "soccerprediction.co.za" :
        define('FILE_PATH', 'C:/SoccerPredictions/Predictions/' , true);
        define('DB_USERNAME', 'root', true);
        define('DB_PW',  '1234', true);
        define('LIVE', false, true);
        define('DB', 'sp_platform', true);
        define('SERVER', 'localhost', true);
        break;
    default :
        define('FILE_PATH', 'C:/SoccerPredictions/Predictions/' , true);
        define('DB_USERNAME', 'root', true);
        define('DB_PW',  '1234', true);
        define('LIVE', false, true);
        define('DB', 'sp_platform', true);
        define('SERVER', 'localhost', true);
        break;
}

//default controller
define('HOME', 'dashboard' , true);
define('SITE_URL', 'https://'.$_SERVER['SERVER_NAME'] , true);

//default prefix
define('LOGIN_URL', '' , true);
define('LOGO_ICON', '/Views/Client/Assets/images/icon2.png' , true);
define('LOGO', '/Views/Client/Assets/softclick.png' , true);
define('EMAIL_LOGO', 'https://ia601508.us.archive.org/4/items/logo2_20180125/logo2.png' , true);

//user roles
define('ADMIN', 'ADM' , true);
define('DEVELOPER', 'DEV' , true);
define('CUSTOMER', 'CST' , true);
define('BRANCH_MANAGER', 'BMU' , true);
define('BRANCH_OPERATOR', 'BUS' , true);
define('COMPANY', 'GUM' , true);

//Transaction result
define('R_SUCCESS', 'SUC' , true);
define('R_UNSUCCESS', 'USC' , true);
define('R_MODIFIED', 'MDF' , true);
define('R_DELETED', 'DEL' , true);

//Payment methods
define('P_EFT', 'EFT' , true);
define('P_CASH', 'CSH' , true);
define('P_BANK_DEPOSIT', 'BKD' , true);

//mailer settings
define('EMAIL_HOST', 'mail.soccerprediction.co.za' , true);
define('EMAIL_USER', 'noreply@soccerprediction.co.za' , true);
define('EMAIL_PASSWORD', 'none2017@' , true);
define('WORDWRAP', 50 , true);
define('NO_REPLY', 'noreply@soccerprediction.co.za' , true);
define('EMAIL_PAYMENT_CONFIRMATION', 'payment@softclicktech.com' , true);
define('EMAIL_NOTICE', 'noreply@soccerprediction.co.za' , true);

//email log settings
define('EMAIL_CAT_CONTACT_US', 1 , true);
define('EMAIL_CAT_NEW_USER', 2 , true);
define('EMAIL_CAT_ACCOUNT_VERIFICATION', 3 , true);
define('EMAIL_CAT_NEW_ORDER', 4 , true);
define('EMAIL_CAT_SUCCESS_PAYMENT', 5 , true);
define('EMAIL_CAT_FAIL_PAYMENT', 6 , true);
define('EMAIL_CAT_OTHER', 0 , true);

//support
define('EMAIL_SUPPORT', 'support@soccerprediction.co.za' , true);
define('EMAIL_CONTACT', 'ayowaberk@gmail.com' , true);
define('EMAIL_FROM_NAME', 'Soccer Prediction' , true);

//Payment gateaway
define('FULL_PAID', 3, true);
define('NOT_PAID', 1, true);

define('SHOP_PICK_UP', 4, true);
define('UNKNOWN', 0, true);

define('PER_PAGE', 56, true);
define('CANCELLED', 'CNL', true);
define('APPROVED', 'APV', true);
define('PENDING', 'PDN', true);

define('THEME_DEFAULT_CODE', 'DEF', true);

define('SMS_SEND_URL', 'https://www.winsms.co.za/api/rest/v1/sms/outgoing/send', true);
define('SMS_API_KEY', '61030DB5-52C3-4834-94AF-42FCC5AF1E2E', true);

BrkORMDatabase::Driver('mysqli')->Setup(SERVER, DB, DB_USERNAME, DB_PW);


?>



