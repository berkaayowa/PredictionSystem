<?php
    namespace util\validation;
    use BerkaPhp\Helper\Check;

    /**
 * Created by PhpStorm.
 * User: f
 * Date: 4/27/2018
 * Time: 12:08 AM
 */
    class Company
    {
        public static function General($company, $branch)
        {
            if($company['IsActive'] == Check::True() && $company['IsDeleted'] == Check::$False)
            {
                if($branch['IsActive'] == Check::True() && $branch['IsDeleted'] == Check::$False)
                {
                    return true;
                }

                return false;
            }

            return false;
        }

    }