<?php
require_once("includes/class/ThumbLib.inc.php");

$src = $_GET['src'];
$x = isset($_GET['x']) ? $_GET['x'] : 100;
$y = isset($_GET['y']) ? $_GET['y'] : 100;
$thumb = PhpThumbFactory::create($src);
$thumb->resize($x, $y);
$thumb->show();
?>
