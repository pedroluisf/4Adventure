<?php
ini_set('include_path', '../includes/class/');
require_once("Config.php");
require_once("Class_MasterPage.php");
require_once("Class_Db.php");
require_once("Class_Utilities.php");
require_once("Class_Validator.php");
require_once("Class_Comments.php");
require_once("Class_Utilities.php");

/**
 *
 * @version
 * @author pedro
 */
$db = new Db();
if(Validator::post('comment') != '') {
    $comment = new Comments();
    $comment->pagid = Validator::post('pagid');
    $comment->name = Validator::post('name');
    $comment->comment = Validator::post('comment');
    $comment->insert();
}

$user = Validator::get('user');
if ($user != '') {
    $sql = "SELECT pagid, title, contents, thumb FROM pages where url='" . $_GET['user'] . ".php'";
    $results = $db->dbQuery($sql);
    $row = $db->dbGetRow($results);
    if ($row){
        $pagid=$row->pagid;
        $title=$row->title;
        $thumb=$row->thumb;
        $contents=$row->contents;    
    }
    if ($thumb!=''){
        $customThumb = '<img src="' . $thumb . '" width="290px" />';
    } else {
        $customThumb = '<img src="images/notfound.png" width="290px" />';
    }
    $pageFound = 1;

} else {

    $customThumb = '<img src="images/notfound.png" width="290px" />';
    $pageFound = 0;
}

$customHead = '<link href="css/comments.css" rel="stylesheet" type="text/css" />' . "\n";

$page = new MasterPage($pagid,$title,$pageFound);
$page->setcustomThumbSection($customThumb);
$page->setcustomHeadSection($customHead);
$page->setcustomMainSection($contents);
$page->show();

?>