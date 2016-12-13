<?php
require_once("../includes/class/Config.php");
require(CLASS_PATH . "Class_Countries.php");
require(CLASS_PATH . "Class_Validator.php");

$task = Validator::request("task");
(bool) $status = false;
(int) $code = 0;

switch($task){
case "add": { 
$countries = new Countries();
$countries->country_name = Validator::request("country_name");
$countries->country_code = Validator::request("country_code");
$status = $countries->insert();
$code = $countries->error_no;
break;
 }
case "edit": { 
$countries = new Countries(Validator::request("cntid"));
$countries->country_name = Validator::request("country_name");
$countries->country_code = Validator::request("country_code");
$status = $countries->update();
$code = $countries->error_no;
break;
 }
case "delete": { 
$countries = new Countries(Validator::request("cntid"));
$status = $countries->delete();
$code = $countries->error_no;
break;
 }
}
header("Location: countries.php?status=" . $status . "&code=" . $code);
?>