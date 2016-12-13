<?php
require_once("../includes/class/Config.php");
require(CLASS_PATH . "Class_Translations.php");
require(CLASS_PATH . "Class_Validator.php");

$task = Validator::request("task");
(bool) $status = false;
(int) $code = 0;

switch($task){
case "add": { 
$translations = new Translations();
$translations->keyword = Validator::request("keyword");
$translations->translation = Validator::request("translation");
$translations->lang = Validator::request("lang");
$status = $translations->insert();
$code = $translations->error_no;
break;
 }
case "edit": { 
$translations = new Translations(Validator::request("trnid"));
$translations->keyword = Validator::request("keyword");
$translations->translation = Validator::request("translation");
$translations->lang = Validator::request("lang");
$status = $translations->update();
$code = $translations->error_no;
break;
 }
case "delete": { 
$translations = new Translations(Validator::request("trnid"));
$status = $translations->delete();
$code = $translations->error_no;
break;
 }
}
header("Location: translations.php?status=" . $status . "&code=" . $code);
?>