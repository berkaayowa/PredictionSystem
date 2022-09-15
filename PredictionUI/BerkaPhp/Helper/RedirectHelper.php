<?php
namespace BerkaPhp\Helper;

class RedirectHelper {

    /*
	* Creates an input field
	* @param  label of the input and an array of attributes
	* @return input field
	* @author berkaPhp Ayowa
	*/
   public static  function redirect($url, $permanent = false, $as_js = false) {

       echo ("<script LANGUAGE='JavaScript'>window.location.href='".$url."';</script>");

    }

}

?>

