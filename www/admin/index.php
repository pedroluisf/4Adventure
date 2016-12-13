<?php
require_once("../../includes/class/Config.php");
require_once(CLASS_PATH . "Class_AdminMasterPage.php");

/**
* 
* @version
* @author pedro
*/

$master = new AdminMasterPage("[ Administração ]");
$master->show();
?>