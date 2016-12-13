<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_MasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Validator.php");
require_once(CLASS_PATH . "Class_Comments.php");
require_once(CLASS_PATH . "Class_Utilities.php");

/**
 *
 * @version
 * @author pedro
 */
if(Validator::post('comment') != '') {

    $db = new Db();
    $comment = new Comments();
    $comment->pagid = Validator::post('pagid');
    $comment->name = Validator::post('name');
    $comment->comment = Validator::post('comment');

    $comment->insert();

}

$sql = "SELECT pagid, title, contents, thumb FROM pages where url='pedro.php'";
$db = new Db();
$results = $db->dbQuery($sql);
$row = $db->dbGetRow($results);
if ($row){
    $pagid=$row->pagid;
    $title=$row->title;
    $thumb=$row->thumb;
    $contents=$row->contents;    
}

ob_clean();
ob_start();
?>

    <img src="%IMG%" width="290px" style="opacity:0.4;filter:alpha(opacity=40)" />

<?php

$customThumb = ob_get_clean();
$customThumb = str_replace("%IMG%", $thumb, $customThumb);

$page = new MasterPage($pagid ,$title);
$page->setcustomThumbSection($customThumb);
$page->setcustomMainSection($contents);
$page->show();

?>