<?php
require_once '../includes/class/Config.php';
require_once CLASS_PATH . 'Class_Authenticate.php';

/**
* 
* @version
* @author pedro
*/

$a = new Authenticate();
$a->logout();
header('Location: login.php');
?>
