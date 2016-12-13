<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_MasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Utilities.php");
require_once(CLASS_PATH . "Class_Validator.php");
require_once(CLASS_PATH . "Class_Comments.php");
require_once(CLASS_PATH . "Class_Utilities.php");

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
$pagina = Validator::get("pagid");
$pageFound = 0;
if ($pagina!='') {
    $sql = "SELECT pagid, thumb, title, contents FROM pages where pagid=" . $pagina . " and catid=2";
    $results = $db->dbQuery($sql);
    $row = $db->dbGetRow($results);
    if ($row) {
        $pageFound = 1;
        $pagid=$row->pagid;
        $title=$row->title;
        $thumb=$row->thumb;
        $contents=$row->contents;
    }
} else {
    $pagid = 0;
    $thumb = "images/calendar.png";
    $title = "Calend&aacute;rio";

    $customHead = '<link href="css/cal.css" rel="stylesheet" type="text/css" />';
    $customHead .= '<script src="js/coda.js"></script>';
    $customHead .= '<script src="js/jquery-1.3.min.js"></script>';
    

    $sql = "SELECT pagid, title, datepost FROM pages where catid=2 ORDER BY datepost DESC ";
    $contents .= '<table>';
    $results = $db->dbQuery($sql);
    while ($row = $db->dbGetRow($results)) {
        $contents .= "<tr><td width=\"20%\"><p><a href=\"calendario.php?pagid=" . $row->pagid . "\">" . Utilities::convertDate2String($row->datepost) . "</a></p></td><td width=\"80%\"><p><a href=\"calendario.php?pagid=" . $row->pagid . "\">" . $row->title . "</a></p></td></tr>";
    }
    $contents .= "</table>";
}

if ($thumb!=''){
    $customThumb = '<img src="' . $thumb . '" width="290px" />';
}

$page = new MasterPage($pagid,$title,$pageFound);
$page->setcustomThumbSection($customThumb);
$page->setCustomHeadSection($customHead);
$page->setcustomMainSection($contents);
$page->show();

?>