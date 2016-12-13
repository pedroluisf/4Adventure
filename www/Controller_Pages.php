<?php
require_once("../includes/class/Config.php");
require(CLASS_PATH . "Class_Pages.php");
require(CLASS_PATH . "Class_Validator.php");

$task = Validator::request("task");
(bool) $status = false;
(int) $code = 0;

switch($task){
case "add": { 
$pages = new Pages();
$pages->catid = Validator::request("catid");
$pages->title = Validator::request("title");
$pages->contents = $_REQUEST["contents"];
$pages->lastupdate = Validator::request("lastupdate");
$pages->url = Validator::request("url");
$pages->thumb = Validator::request("thumb");
$pages->lang = Validator::request("lang");
$pages->datepost = (Validator::request("datepost") == '' ? '0000-00-00' : Validator::request("datepost")) . ' ' . Validator::request("timepost");
$status = $pages->insert();
$code = $pages->error_no;
break;
 }
case "edit": { 
$pages = new Pages(Validator::request("pagid"));
$pages->catid = Validator::request("catid");
$pages->title = Validator::request("title");
$pages->contents = $_REQUEST["contents"];
$pages->lastupdate = Validator::request("lastupdate");
$pages->url = Validator::request("url");
$pages->thumb = Validator::request("thumb");
$pages->lang = Validator::request("lang");
$pages->datepost = (Validator::request("datepost") == '' ? '0000-00-00' : Validator::request("datepost")) . ' ' . Validator::request("timepost");
$status = $pages->update();
$code = $pages->error_no;
break;
 }
case "delete": { 
$pages = new Pages(Validator::request("pagid"));
$status = $pages->delete();
$code = $pages->error_no;
break;
 }
}
header("Location: pages.php?status=" . $status . "&code=" . $code);
?>