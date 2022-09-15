<?php
namespace BerkaPhp\Helper;

class Element {

    /*
	* Creates an input field
	* @param  label of the input and an array of attributes
	* @return input field
	* @author berkaPhp Ayowa
    *
    */

    public static function Render($element_name, $prefix = '', $model = null) {
        if(!empty($prefix )) {
            $element_path = "Views/".$prefix."/Elements/{$element_name}.php";
        } else {
            $element_path = "Views/Elements/{$element_name}.php";
        }

        if(file_exists($element_path)) {
            require($element_path);
        } else {
            die("{$element_path} Could not find");
        }
    }

}