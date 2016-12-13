<?php
require_once("Config.php");
/**
 *
 * @version 1
 * @author pedro
 */

class Files {

    public function  __construct() {

    }

    /**
     * Uploads an image file to a directory.
     * @param String $fileFieldName The file field name in the $_FILES array.
     * @param String $destination The destination directory.
     * @param String $filename The resulting filename (passed by reference).
     * @return Boolean True if file uploaded ok, False otherwise.
     */
    public static function uploadFile($fileFieldName, $destination, &$filename) {
        if($_FILES[$fileFieldName]["name"] != "") {

            // return false if filename exists
            if(file_exists($_FILES[$fileFieldName]["name"])) {
                return false;
            }

            $filename = $_FILES[$fileFieldName]["name"];
            $filesize = $_FILES[$fileFieldName]["size"] / 1024;
            $filetype = $_FILES[$fileFieldName]["type"];
            $tmpfilename = $_FILES[$fileFieldName]["tmp_name"];

            // check filesize
            $maxfilesize = ini_get("upload_max_filesize");
            $maxfilesize *= 1024;

            if($filesize > $maxfilesize) {
                return false;
            }

            // check file type (jpg, png, gif)
            switch($filetype) {
                case "image/jpeg"  :
                case "image/pjpeg" :
                case "image/png"   :
                case "image/gif"   : {
                        break;
                    }
                default            : {
                        return false;
                        break;
                    }
            }

            // check if tmp file exists
            if(!file_exists($tmpfilename)) {
                return false;
            }

            // all basic test are ok at this point
            // move file to dest dir and check ok at dir
            if(!move_uploaded_file($tmpfilename, $destination.$filename)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Deletes a file from a directory.
     * @param String $filename The name of the file to delete (must include dir).
     * @return Boolean Always true.
     */
    public static function deleteFile($filename) {
         // verify that file exists
        if(is_file($filename) && file_exists($filename)) {
            unlink($filename);
        }

        return true;
    }
}
?>
