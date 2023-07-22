<?php
namespace berkaPhp\config;

use BerkaPhp\Database\DB;
use BrkORM\BrkORMDatabase;

define('DEBUG', false, true);
define('LIVE_TEST', true, true);
define('SYS_NAME', 'Free Daily Soccer Betting | Tips | Predictions' , true);
define('DATE_FORMAT', 'Y-m-d h:m:s' , true);
define('DATE_SECOND_FORMAT', 'd-m-Y h:m' , true);
define('DATE_THIRD_FORMAT', 'd-m-Y' , true);
define('DATE_NOW', date(DATE_FORMAT) , true);

//Database settings

switch ($_SERVER['SERVER_NAME']) {
    case "soccer.isenduget.co.za" :
    case "soccerprediction.co.za" :
        define('FILE_PATH', 'C:/PhpSites/Prediction/' , true);
        break;
    default :
        define('FILE_PATH', 'C:/SoccerPredictions/Predictions/' , true);
        break;
}

switch ($_SERVER['SERVER_NAME']) {
    case "msg.isenduget.co.za" :
        define('DB_USERNAME', 'root', true);
        define('DB_PW',  '1234', true);
        define('LIVE', false, true);
        define('DB', 'sms', true);
        define('SERVER', 'localhost', true);
        break;
    default :
        define('DB_USERNAME', 'root', true);
        define('DB_PW',  '1234', true);
        define('LIVE', false, true);
        define('DB', 'sms', true);
        define('SERVER', 'localhost', true);
        break;
}


//default controller
define('HOME', 'dashboard' , true);
define('SITE_URL', 'http://'.$_SERVER['SERVER_NAME'] , true);

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
define('EMAIL_HOST', 'mail.softclicktech.com' , true);
define('EMAIL_USER', 'noreply@softclicktech.com' , true);
define('EMAIL_PASSWORD', 'none2017@' , true);
define('WORDWRAP', 50 , true);
define('NO_REPLY', 'noreply@softclicktech.com' , true);
define('EMAIL_PAYMENT_CONFIRMATION', 'payment@softclicktech.com' , true);
define('EMAIL_NOTICE', 'notice@softclicktech.com' , true);

//email log settings
define('EMAIL_CAT_CONTACT_US', 1 , true);
define('EMAIL_CAT_NEW_USER', 2 , true);
define('EMAIL_CAT_ACCOUNT_VERIFICATION', 3 , true);
define('EMAIL_CAT_NEW_ORDER', 4 , true);
define('EMAIL_CAT_SUCCESS_PAYMENT', 5 , true);
define('EMAIL_CAT_FAIL_PAYMENT', 6 , true);
define('EMAIL_CAT_OTHER', 0 , true);

//support
define('EMAIL_SUPPORT', 'berka@softclicktech.com' , true);
define('EMAIL_CONTACT', 'ayowaberk@gmail.com' , true);
define('EMAIL_FROM_NAME', 'Softclicktech.com' , true);

//Payment payfast

if(SITE_URL == 'http://sms.softclick.xyz') {
    define('PAYFAST_MERCHANT_ID', 12500391 , true);
    define('PAYFAST_MERCHANT_KEY', 'htavfq7j0iv91' , true);
    define('PAYFAST_TEST_URL', 'https://www.payfast.co.za/eng/process' , true);

    define('PAYPAL_LIVE_URL', 'https://www.paypal.com/cgi-bin/webscr', true);
    define('PAYPAL_LIVE_BUSINESS', 'ayowaberka@gmail.com', true);

    define('PAYMENT_SUCCESS_URL', SITE_URL.'/client/payment/success' , true);
    define('PAYMENT_NOTIFICATION_URL', SITE_URL.'/client/payment/notice' , true);
    define('PAYMENT_ERROR_URL', SITE_URL.'/client/payment/cancel' , true);

} else if(SITE_URL == 'http://api-test.softclicktech.com') {
    define('PAYFAST_MERCHANT_ID', 12500391 , true);
    define('PAYFAST_MERCHANT_KEY', 'htavfq7j0iv91' , true);
    define('PAYFAST_TEST_URL', 'https://www.payfast.co.za/eng/process' , true);

    define('PAYPAL_LIVE_URL', 'https://www.paypal.com/cgi-bin/webscr', true);
    define('PAYPAL_LIVE_BUSINESS', 'ayowaberka@gmail.com', true);

    define('PAYMENT_SUCCESS_URL', SITE_URL.'/client/payment/success' , true);
    define('PAYMENT_NOTIFICATION_URL', SITE_URL.'/client/payment/notice' , true);
    define('PAYMENT_ERROR_URL', SITE_URL.'/client/payment/cancel' , true);
}else {
    define('PAYFAST_MERCHANT_ID', 12500391 , true);
    define('PAYFAST_MERCHANT_KEY', 'htavfq7j0iv91' , true);
    define('PAYFAST_TEST_URL', 'https://sandbox.payfast.co.za/eng/process' , true);

    define('PAYPAL_TEST_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr', true);
    define('PAYPAL_TEST_BUSINESS', 'business@softclicktech.com', true);

    define('PAYMENT_SUCCESS_URL', 'http://api-test.softclicktech.com/client/payment/success' , true);
    define('PAYMENT_NOTIFICATION_URL', 'http://api-test.softclicktech.com/client/payment/notice' , true);
    define('PAYMENT_ERROR_URL', 'http://api-test.softclicktech.com/client/payment/cancel' , true);
}


define('PAYFAST_POST_URL', LIVE ? PAYFAST_LIVE_URL : PAYFAST_TEST_URL, true);

define('PAYPAL_POST_URL',  LIVE ? PAYPAL_LIVE_URL : PAYPAL_TEST_URL, true);
define('PAYPAL_BUSINESS', LIVE ? PAYPAL_LIVE_BUSINESS : PAYPAL_TEST_BUSINESS, true);

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

//BrkORMDatabase::Driver('mysqli')->Setup(SERVER, DB, DB_USERNAME, DB_PW,
//    [
//        'user'=>'user_log',
//        'purchase'=>'purchase_log'
//    ]
//);


?>



