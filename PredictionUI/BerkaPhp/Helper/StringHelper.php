<?php
namespace BerkaPhp\Helper;

class Str {

    /*
	* Creates an input field
	* @param  label of the input and an array of attributes
	* @return input field
	* @author berkaPhp Ayowa
	*/
    public static function limitChar($value, $number, $x = '') {

        $value = html_entity_decode($value);
        return !empty($value) ? substr($value, 0, $number).$x : '';
    }

    public static function dbEscapeString($value) {
        //mysql_real_escape_string($value)
        return $value;
    }

}

?>
