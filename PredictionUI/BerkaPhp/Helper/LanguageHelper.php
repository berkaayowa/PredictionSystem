<?php
namespace BerkaPhp\Helper;
use \BerkaPhp\Helper\SessionHelper;

class Language {

    /*
	* Creates an input field
	* @param  label of the input and an array of attributes
	* @return input field
	* @author berkaPhp Ayowa
	*/
    private $amount;
    private $base;
    private $url;
    private static $instance;

    public static function Init($lang = null) {

        if($lang == null)
            $lang = !empty(Auth::GetActiveUser(false)->language->Code) ? Auth::GetActiveUser(false)->language->Code : 'EN';

        if(!SessionHelper::exist('Lang')){
            SessionHelper::add('Lang', $lang);
        } else {
            SessionHelper::update('Lang', $lang);
        }
        return self::getLanguage();
    }


    public static function getLanguage() {

        if(!SessionHelper::exist('Lang')){
            return Language::Init();
        } else {
            return SessionHelper::get('Lang');
        }

    }

}

?>
