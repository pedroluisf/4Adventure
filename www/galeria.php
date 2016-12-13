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

$customHead .= '<link href="css/jqscrollable.css" rel="stylesheet" type="text/css" />' . "\n";
$customHead .= '<script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>' . "\n";

$title = "Galeria";
$sql = "SELECT pagid, title, thumb, left(contents, 280) as description, datepost FROM pages where catid=4 ORDER BY lastupdate DESC ";
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
    $scrollable .= "<strong>$pagdatepost</strong><br/><br/>\n";
    $scrollable .= "<p><a href=\"photos.php?pagid=$pagpagid\">Ver Album</a></p>\n";
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
    <h3>Visualize aqui fotos e videos dos nossos eventos e aventuras.</h3>
    <div id="actions"> 
            <a class="prev" >Recuar</a> 
            <a class="next" >Avan&ccedil;ar</a>
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

$customThumb .= '<img src="images/gallery.png" width="280px" />';    

$page = new MasterPage($pagid,$title,$pageFound);
$page->setcustomHeadSection($customHead);
$page->setcustomThumbSection($customThumb);
$page->setcustomMainSection($customContents);
$page->show();

?>