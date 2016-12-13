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

$customHead .= '<link href="css/comments.css" rel="stylesheet" type="text/css" />' . "\n";
$customHead .= '<link href="css/jqscrollable.css" rel="stylesheet" type="text/css" />' . "\n";
$customHead .= '<link href="css/jqoverlay.css" rel="stylesheet" type="text/css" />' . "\n";
$customHead .= '<script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>' . "\n";

$pagid = 0;
$pagina = Validator::get("pagid");
$pageFound = 0;
if ($pagina!='') {
    $sql = "SELECT pagid, thumb, title, contents FROM pages where pagid=" . $pagina . " and catid=3";
    $results = $db->dbQuery($sql);
    $row = $db->dbGetRow($results);
    if ($row) {
        $pageFound = 1;
        $pagid=$row->pagid;
        $title=$row->title;
        $thumb=$row->thumb;
        $customContents=$row->contents;
    }
    
} else {
    $thumb = "images/flag.png";
    $title = "Not&iacute;cias";
    $sql = "SELECT pagid, title, thumb, left(contents, 280) as description, datepost FROM pages where catid=3 ORDER BY lastupdate DESC ";
    $results = $db->dbQuery($sql);
    $itemnumber=0;
    $scrollable = '<div class="items">';
    while ($row = $db->dbGetRow($results)) {
        if ($itemnumber % 3 == 0){
            $scrollable .= '<div>';
        }
        $pagthumb = $row->thumb;
        $pagtitle = $row->title;
        $pagdesc = strip_tags($row->description) . '(...)';
        $pagpagid = $row->pagid;
        $pagdatepost = Utilities::convertDate2String($row->datepost, 4);
        $scrollable .= "<div class=\"item\">\n";
        if (is_null($pagthumb) || $pagthumb == ''){
            $scrollable .= "<img src=\"images/notfound.png\" />\n";
        }else{
            $scrollable .= "<img src=\"$pagthumb\" />\n";                
        }
        $scrollable .= "<div class=\"text\">\n";
        $scrollable .= "<h3>$pagtitle</h3><br/>\n";
        $scrollable .= "<p>$pagdesc</p><br/>\n";
        $scrollable .= "<strong>$pagdatepost</strong>\n";
        $scrollable .= "<p style=\"float:right;\"><a href=\"noticias.php?pagid=$pagpagid\">Ver not&iacute;cia completa</a></p>\n";
        $scrollable .= "</div>\n";
        $scrollable .= "</div>\n";
        $itemnumber++;
        if ($itemnumber % 3 == 0){
            $scrollable .= '</div>';
        }
    }
    if ($itemnumber % 3 != 0){
        $scrollable .= '</div>';                
    }
    $scrollable .= '</div>';
    
    ob_clean();
    ob_start();
    ?>
        <h3>Acompanhe aqui algumas das novidades da viagem, noticias do mundo do desporto, competi&ccedil;&atilde;o, aventura e divers&atilde;o.</h3>
        <div id="actions"> 
                <a class="prev" style="cursor:pointer;">Recuar</a> 
                <a class="next" style="">Avan&ccedil;ar</a>
        </div> 

        <!-- root element for scrollable -->
        <div class="scrollable vertical">
            
            <?php echo $scrollable; ?>

        </div>

    <!-- javascript coding --> 
    <script> 
    // execute your scripts when DOM is ready. this is a good habit
    $(function() {		
            // initialize scrollable with mousewheel support
            $(".scrollable").scrollable({ vertical: true, mousewheel: true });	
    });
    </script> 

    <?php
    $customContents = ob_get_clean();
    
}

if ($thumb!='' && $pagid != 0){

    $customThumb .= '<div id="triggers"><img src="' . $thumb . '" width="280px" rel="#photo1" /></div>' . "\n"; 
    $customThumb .= '<div class="apple_overlay black" id="photo1">' . "\n"; 
    $customThumb .= '<img src="' . $thumb. '" width="780px" />' . "\n"; 
    $customThumb .= '<div class="details">' . "\n"; 
    $customThumb .= '<h2>' . $title . '</h2>' . "\n"; 
    $customThumb .= '</div>' . "\n"; 
    $customThumb .= '</div>' . "\n";

    $customThumb .= '<script>' . "\n"; 
    $customThumb .= '$(function() {';
    $customThumb .= '$("#triggers img[rel]").overlay({effect: "apple"});';
    $customThumb .= '});' . "\n";
    $customThumb .= '</script>' . "\n";
    
} else if ($thumb!=''){

    $customThumb .= '<img src="' . $thumb . '" width="280px" />';    

}

$page = new MasterPage($pagid,$title,$pageFound);
$page->setcustomHeadSection($customHead);
$page->setcustomThumbSection($customThumb);
$page->setcustomMainSection($customContents);
$page->show();

?>