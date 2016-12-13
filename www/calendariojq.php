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
/*
 * Calendario Lista

 */
    
    
    
/*
 * Calendario Dinamico
 */
    $year = Validator::get("year");
    $month = Validator::get("month");

    if (!is_numeric($year) || !is_numeric($month)){
        $year = date('Y');
        $month = date('m');
    } elseif ($year < 2011 || $month < 1 || $month > 12 ){
        $year = date('Y');
        $month = date('m');
    }

    /* Keep all events is a month_Day indexed array */
    $sql = "SELECT pagid, title, datepost FROM pages where catid=2 and month(datepost)=$month and year(datepost)=$year ORDER BY datepost DESC ";
    $results = $db->dbQuery($sql);
    while ($row = $db->dbGetRow($results)) {
        $event = '<li>' . $row->title . '</li>' . $arr[date('j',$row->datepost)];
        $arr = array(date('j',$row->datepost) => $event);
    }
    
    /* Build Calendar */
    $contents .= '<table>';
    $caldate = mktime(0, 0, 0, $month, 5, $year);
    $dayweek = date('w', $caldate);

    
    

    $contents .= "</table>";

    ob_clean();    
    ob_start();

?>
        <table id="tablecal" cellspacing="0">
                <thead id="theadcal" >
                        <tr>
                                <th id="tdcal">Mon</th><th id="tdcal">Tue</th><th id="tdcal">Wed</th>
                                <th id="tdcal">Thu</th><th id="tdcal">Fri</th><th id="tdcal">Sat</th>
                                <th id="tdcal">Sun</th>
                        </tr>
                </thead>
                <tbody id="theadcal">
                        <tr>
                                <td class="padding" colspan="3"></td>
                                <td id="tdcal"> 1</td>
                                <td id="tdcal"> 2</td>
                                <td id="tdcal"> 3</td>
                                <td id="tdcal"> 4</td>
                        </tr>
                        <tr>
                                <td id="tdcal"> 5</td>
                                <td id="tdcal"> 6</td>
                                <td id="tdcal"> 7</td>
                                <td id="tdcal"> 8</td>
                                <td class="today"> 9</td>
                                <td id="tdcal">10</td>
                                <td id="tdcal">11</td>
                        </tr>
                        <tr>
                                <td id="tdcal">12</td>
                                <td class="date_has_event">
                                        13
                                        <div class=".events">
                                                <ul>
                                                        <li>
                                                                <span class="title">Event 1</span>
                                                                <span class="desc">Lorem ipsum dolor sit amet, consectetu adipisicing elit.</span>
                                                        </li>
                                                        <li>
                                                                <span class="title">Event 2</span>
                                                                <span class="desc">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>
                                                        </li>
                                                </ul>
                                        </div>
                                </td>
                                <td id="tdcal">14</td>
                                <td id="tdcal">15</td>
                                <td id="tdcal">16</td>
                                <td id="tdcal">17</td>
                                <td id="tdcal">18</td>
                        </tr>
                        <tr>
                                <td id="tdcal">19</td>
                                <td id="tdcal">20</td>
                                <td id="tdcal">21</td>
                                <td class="date_has_event">
                                        22
                                        <div class="events">
                                                <ul>
                                                        <li>
                                                                <span class="title">Event 1</span>
                                                                <span class="desc">Lorem ipsum dolor sit amet, consectetu adipisicing elit.</span>
                                                        </li>
                                                        <li>
                                                                <span class="title">Event 2</span>
                                                                <span class="desc">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>
                                                        </li>
                                                </ul>
                                        </div>
                                </td>
                                <td id="tdcal">23</td>
                                <td id="tdcal">24</td>
                                <td id="tdcal">25</td>
                        </tr>	
                        <tr>
                                <td id="tdcal">26</td>
                                <td id="tdcal">27</td>
                                <td id="tdcal">28</td>
                                <td id="tdcal">29</td>
                                <td id="tdcal">30</td>
                                <td id="tdcal">31</td>
                                <td class="padding"></td>
                        </tr>
                </tbody>
                <tfoot if="tfootcal" >
                        <th id="tdcal">Mon</th><th id="tdcal">Tue</th><th id="tdcal">Wed</th>
                        <th id="tdcal">Thu</th><th id="tdcal">Fri</th><th id="tdcal">Sat</th>
                        <th id="tdcal">Sun</th>
                </tfoot>
        </table>    

    <?php
    $contents .= ob_get_clean();

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