<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_Brands.php");
require_once(CLASS_PATH . "Class_Validator.php");
require_once(CLASS_PATH . "Class_Files.php");

$task = Validator::request("task");
(bool) $status = false;
(int) $code = 0;

$files = new Files();

if(strlen($_FILES['logo']['tmp_name']) > 0) {
    // vamos verificar se o ficheiro tem a altura igual a largura
    // para manter a proporηγo
    $imgInfo = getimagesize($_FILES['logo']['tmp_name']);
    $width = $imgInfo[0]; // width;
    $height = $imgInfo[1]; // height;
    if(($width / $height) != 1) {
        $code = -3;
        header("Location: brands.php?status=" . $status . "&code=" . $code);
    }
}
$dbFilename = Validator::request("dbLogo");
$filename = '';
if($files->uploadFile('logo', UPLOAD_PATH, $filename)) {
    if(strlen($filename) == 0 && strlen($dbFilename) > 0 ) {
        $filename = $dbFilename;
    }
}

switch($task) {
    case "add": {
            $brands = new Brands();
            $brands->name = Validator::request("name");
            $brands->url = Validator::request("url");
            $brands->logo = $filename;
            $status = $brands->insert();
            $code = $brands->error_no;
            break;
        }
    case "edit": {
            $brands = new Brands(Validator::request("brdid"));
            $brands->name = Validator::request("name");
            $brands->url = Validator::request("url");
            $brands->logo = $filename;
            $status = $brands->update();
            $code = $brands->error_no;
            break;
        }
    case "delete": {
            $files->deleteFile($filename);
            $brands = new Brands(Validator::request("brdid"));
            $status = $brands->delete();
            $code = $brands->error_no;
            break;
        }
}
header("Location: brands.php?status=" . $status . "&code=" . $code);
?>