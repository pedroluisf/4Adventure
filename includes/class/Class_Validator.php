<?php
/**
 * Class to manipulate validation and sanitization of data.
 * @version 2
 * @author pedro
 */
class Validator {
    public function  __construct() {
    }

    /**
     * Checks if a variable is present in the REQUEST array.
     * @param String $str Then name of the variable.
     * @return Boolean True if variable is in the array, False otherwise.
     */
    public static function exists($str) {
        return isset($_REQUEST[$str]);
    }

    /**
     * Checks if the given string is empty.
     * @param String $str The string to check.
     * @return Boolean True if the string is NOT empty, False otherwise.
     */
    public static function isFilled($str) {
        if(strlen($str) > 0) {
            return true;
        }
        return false;
    }

    /**
     * Checks if given string is an email address.
     * @param String $str The string to check.
     * @return Boolean True if the string is an email address, False otherwise.
     */
    public static function isEmail($str) {
        if(filter_var($str, FILTER_VALIDATE_EMAIL) != false) {
            return true;
        }
        return false;
    }

    /**
     * Checks if a given var is set in the POST array, and if so returns a
     * clean version of the value.
     * @param String $str The name of the var to check in the array.
     * @return String The clean version of the value in the array, or empty if the var is not set.
     */
    public static function post($str) {
        if(isset ($_POST[$str]) && strlen($_POST[$str])) {
            return filter_var($_POST[$str], FILTER_SANITIZE_STRING);
        }

        return '';
    }

    /**
     * Checks if a given var is set in the GET array, and if so returns a
     * clean version of the value.
     * @param String $str The name of the var to check in the array.
     * @return String The clean version of the value in the array, or empty if the var is not set.
     */
    public static function get($str) {
        if(isset ($_GET[$str]) && strlen($_GET[$str])) {
            return filter_var($_GET[$str], FILTER_SANITIZE_STRING);
        }

        return '';
    }

    /**
     * Checks if a given var is set in the REQUEST array, and if so returns a
     * clean version of the value.
     * @param String $str The name of the var to check in the array.
     * @return String The clean version of the value in the array, or empty if the var is not set.
     */
    public static function request($str) {
        if(isset ($_REQUEST[$str]) && strlen($_REQUEST[$str])) {
            return filter_var($_REQUEST[$str], FILTER_SANITIZE_STRING);
        }

        return '';
    }

    /**
     * Checks if a given var is set in the SESSION array, and if so returns a
     * clean version of the value.
     * @param String $str The name of the var to check in the array.
     * @return String The clean version of the value in the array, or empty if the var is not set.
     */
    public static function session($str) {
        if(isset ($_SESSION[$str]) && strlen($_SESSION[$str])) {
            return filter_var($_SESSION[$str], FILTER_SANITIZE_STRING);
        }

        return '';
    }

    /**
     * Checks if a given var is set in the FILES array, and if so returns a
     * clean version of the value (being value the file name).
     * @param String $str The name of the var to check in the array.
     * @return String The clean version of the value in the array, or empty if the var is not set.
     */
    public static function files($str) {
        if(isset ($_FILES[$str]) && strlen($_FILES[$str])) {
            return filter_var($_FILES[$str]['name'], FILTER_SANITIZE_STRING);
        }

        return '';
    }
}
?>
