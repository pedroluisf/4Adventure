<?php
require_once("../includes/class/Config.php");
require(CLASS_PATH . "Class_Languages.php");
require(CLASS_PATH . "Class_Validator.php");

$task = Validator::request("task");
(bool) $status = false;
(int) $code = 0;

switch($task){
case "add": { 
$languages = new Languages();
$languages->language = Validator::request("language");
$status = $languages->insert();
$code = $languages->error_no;
break;
 }
case "edit": { 
$languages = new Languages(Validator::request("langid"));
$languages->language = Validator::request("language");
$status = $languages->update();
$code = $languages->error_no;
break;
 }
case "delete": { 
$languages = new Languages(Validator::request("langid"));
$status = $languages->delete();
$code = $languages->error_no;
break;
 }
}
header("Location: languages.php?status=" . $status . "&code=" . $code);
?>