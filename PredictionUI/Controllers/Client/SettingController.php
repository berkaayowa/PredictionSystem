<?php

	namespace Controller\Client;
	use BerkaPhp\Controller\BerkaPhpController;
    use BerkaPhp\Helper\Auth;
    use BerkaPhp\Helper\Check;
    use BerkaPhp\Helper\Currency;
    use BerkaPhp\Helper\Language;
    use BerkaPhp\Helper\Rand;
    use BerkaPhp\Helper\SessionHelper;
    use BrkORM\T;
    use Resource\Label;

    class SettingController extends BerkaPhpController
	{
        private $currencies;
        private $languages;

		function __construct() {
			parent::__construct(false);
            $this->currencies = ['USD', 'EUR', 'ZAR'];
            $this->languages = ['FR', 'EN'];
		}

		function currency($params = '') {

            $currency = $params['args']['params'][0];

            if(in_array($currency, $this->currencies)){

                if(Currency::Init()->updateCurrency($currency)){
                    sleep(1);
                    return $this->jsonFormat(['error'=> false, 'message'=>'Currency updated successfully', 'success'=>true]);
                } else {
                    return $this->jsonFormat(['error'=> true, 'message'=>'Error could not update currency, try again', 'success'=>false]);
                }
            } else {
                return $this->jsonFormat(['error'=> true, 'message'=>'The requested currency is not allowed!', 'success'=>false]);
            }

		}

        function lang($params = '') {

            $lang = $params['args']['params'][0];

            if(in_array($lang, $this->languages)){

                Language::Init($lang);

                if(Language::getLanguage() == $lang){

                    $language = T::Find('language')
                        ->Where('IsDeleted', '=', Check::$False)
                        ->Where('Code', '=', $lang)
                        ->FetchFirstOrDefault();

                    if($language->IsAny()) {
                        $user = T::Find('user')
                            ->Where('UserID', '=',  Auth::GetActiveUser()->UserID)
                            ->Where('IsDeleted', '=', Check::$False)
                            ->FetchFirstOrDefault();
                        if($user->IsAny()) {
                            $user->RefLanguageID = $language->LanguageID;
                            $user->Save();
                        }
                    }

                    sleep(1);

                    return $this->jsonFormat(['error'=> false, 'message'=>Label::Success('LanguageUpdated'), 'success'=>true]);
                } else {
                    return $this->jsonFormat(['error'=> true, 'message'=>'Error could not update Language, try again', 'success'=>false]);
                }
            } else {
                return $this->jsonFormat(['error'=> true, 'message'=>'The requested Language is not allowed!', 'success'=>false]);
            }

        }

        function generatepin(){
            return $this->jsonFormat(['error'=> false, 'message'=>false, 'success'=>true, 'pin'=>Rand::uniqueDigit(100, 10000)]);
        }

        function navigation($params = '') {

            $nav = "off";

            if(SessionHelper::exist('navigation')) {

                $nav = SessionHelper::get('navigation');
                if($nav == 'on') {
                   $nav = "off";
                }
                else {
                    $nav = "on";
                }

                SessionHelper::remove('navigation');

            }

            SessionHelper::update('navigation', $nav);

            if(SessionHelper::exist('navigation')) {
                return $this->jsonFormat(['error'=> false, 'message'=>false, 'success'=>true]);
            } else {
                return $this->jsonFormat(['error'=> true, 'message'=>false, 'success'=>false]);
            }

        }

	}



?>