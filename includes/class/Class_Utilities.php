<?php

require_once("Config.php");
require_once(CLASS_PATH . "Class_Db.php");

/**
 * 
 * @version 1
 * @author pedro
 */
class Utilities {

    public function __construct() {
        
    }

    /**
     * <p>Build an HTML combobox based on an SQL query.
     * Query should have the following format SELECT <value>, <string> FROM table1 WHERE <conditions>.</p>
     * @param String $id The id for the <select> tag.
     * @param String $name The name for the <select> tag.
     * @param String $sql The sql query to be executed (should be already prepared).
     * @param String $selected The selected value in the combobox.
     */
    public static function htmlCombobox($id, $name, $sql, $selected=null) {
        $db = new Db();
        $r = $db->dbQuery($sql);
        echo "<select id=\"" . $id . "\" name=\"" . $name . "\">\n";
        while ($row = $db->dbGetRow($r, "array")) {
            if ($selected != null && $selected == $row[0]) {
                echo "<option value=\"" . $row[0] . "\" selected=\"selected\">" . $row[1] . "</option>\n";
            } else {
                echo "<option value=\"" . $row[0] . "\">" . $row[1] . "</option>\n";
            }
        }
        echo "</select>";
    }

    /**
     * Transform empty values into null values.
     * @param String $str The string we wish to check.
     * @return NULL if string is empty, or the string itself if not.
     */
    public static function empty2null($str) {
        return trim($str) == "" ? null : $str;
    }

    /**
     * Transform image path to its corresponding thumb path as expected in JQuery Gallery
     * @param String $str The image path to chenge.
     * @return empty or thumb path if string not empty.
     */
    public static function image2thumb($str) {
        if(Utilities::right($str, 4)=='.jpg'){
            return Utilities::left($str, strlen($str) - 4) . '_t.jpg';
        } else if(Utilities::right($str, 4)=='.JPG'){
            return Utilities::left($str, strlen($str) - 4) . '_t.JPG';
        } else if(Utilities::right($str, 4)=='.gif'){
            return Utilities::left($str, strlen($str) - 4) . '_t.gif';
        } else if(Utilities::right($str, 4)=='.GIF'){
            return Utilities::left($str, strlen($str) - 4) . '_t.GIF';
        } else if(Utilities::right($str, 4)=='.bmp'){
            return Utilities::left($str, strlen($str) - 4) . '_t.bmp';
        } else if(Utilities::right($str, 4)=='.BMP'){
            return Utilities::left($str, strlen($str) - 4) . '_t.BMP';
        } else {
            return $str;
        }
    }

    /**
     * Gets the current page name.
     * @return String The page name.
     */
    public static function getPageName() {
        $pageName = basename($_SERVER['REQUEST_URI']);
        if (strpos($pageName, "?") !== false)
            $pageName = reset(explode("?", $pageName));
        return $pageName;
    }

    /**
     * Gets the Right part of a string.
     * @return String The page name.
     */
    public static function right($string, $chars) {
        $vright = substr($string, strlen($string) - $chars, $chars);
        return $vright;
    }

    /**
     * Gets the Left part of a string.
     * @return String The page name.
     */
    public static function left($string, $chars) {
        $vright = substr($string, 0, $chars);
        return $vright;
    }

    /*
      @format
      1 - January 1, 1970 12:00:00 AM/PM  # full date and 12 hour format (default)
      2 - January 1, 1970 23:00:00   # full date and 24 hour format
      3 - Jan 1, 1970 12:00:00 AM/PM  #short date and 12 hour format
      4 - Jan 1, 1970 24:00:00 # short date and 24 hour format
     */

    function convertDate2String($inputDate, $dateFormat=4) {
        $temp = '';
        if ($inputDate=='0000-00-00 00:00:00' || $inputDate=='1970-01-01 00:00:00'){
            return '';
        }
        
        switch ($dateFormat) {
            case 1:
                $temp = date('F d, Y h:i A', strtotime($inputDate));
                break;
            case 2:
                $temp =  date('F d, Y G:i', strtotime($inputDate));
                break;
            case 3:
                $temp =  date('M d, Y h:i A', strtotime($inputDate));
                break;

            case 4:
                $temp = date('M d, Y G:i', strtotime($inputDate));
                break;
        }

        if ($dateFormat == 4){
            if (Utilities::left($temp, 12) == 'Jan 01, 1970'){
                $temp = Utilities::right($temp, 5);
            }
            if (Utilities::right($temp, 5) == ' 0:00'){
                $temp = substr($temp, 0, strlen($temp) - 5);
            }
            return $temp;
        }
        
    }

}

?>
