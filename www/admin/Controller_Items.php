<?php
require_once("../includes/class/Config.php");
require(CLASS_PATH . "Class_Items.php");
require(CLASS_PATH . "Class_Validator.php");

$task = Validator::request("task");
(bool) $status = false;
(int) $code = 0;

switch($task){
case "add": { 
$items = new Items();
$items->brand_id = Validator::request("brand_id");
$items->cat_id = Validator::request("cat_id");
$items->ref = Validator::request("ref");
$items->price = Validator::request("price");
$status = $items->insert();
$code = $items->error_no;
break;
 }
case "edit": { 
$items = new Items(Validator::request("itmid"));
$items->brand_id = Validator::request("brand_id");
$items->cat_id = Validator::request("cat_id");
$items->ref = Validator::request("ref");
$items->price = Validator::request("price");
$status = $items->update();
$code = $items->error_no;
break;
 }
case "delete": { 
$items = new Items(Validator::request("itmid"));
$status = $items->delete();
$code = $items->error_no;
break;
 }
}
header("Location: items.php?status=" . $status . "&code=" . $code);
?>