<?php
namespace BerkaPhp\Helper;

class Check {

    /*
	* Creates an input field
	* @param  label of the input and an array of attributes
	* @return input field
	* @author berkaPhp Ayowa
	*/
    public static function Boolean($value) {
        return  $value == '1' ? true : false;
    }

    public static $True = '1';

    public static $False = '0';



}

?>
