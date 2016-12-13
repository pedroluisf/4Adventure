<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_LargeMasterPage.php");
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
if(Validator::get('pagid') == '') {
    header('Location:galeria.php');
}

if(Validator::post('comment') != '') {
    $comment = new Comments();
    $comment->pagid = Validator::post('pagid');
    $comment->name = Validator::post('name');
    $comment->comment = Validator::post('comment');
    $comment->insert();
}

$pagid = 0;
$pagina = Validator::get("pagid");
$pageFound = 0;
if ($pagina!='') {
    $sql = "SELECT pagid, title, contents FROM pages where pagid=$pagina and catid=4";
    $results = $db->dbQuery($sql);
    if ($row = $db->dbGetRow($results)) {
        $pageFound = 1;
        $pagid=$row->pagid;
        $title=$row->title . ' - V&iacute;deos';
        $thumb=$row->thumb;
        $contents=$row->contents;
    }    
} 

if ($pageFound == 0) {
    header('Location:galeria.php');
}
    
ob_clean();
ob_start();
?>
        <link href="css/comments.css" rel="stylesheet" type="text/css" />
        <link href="css/jqtabs-slideshow.css" rel="stylesheet" type="text/css" />
        <!-- fix IE "black box" problems with PNG images when opacity is being animated --> 
            <!--[if IE]>
            <style type="text/css">
            .images img {
                    background:#efefef url(/img/global/gradient/h300.png) repeat-x 0 -22px;
            }
            </style>
            <![endif]--> 
        <script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>
<?php
$customHead =  ob_get_clean();

$customContents = "<div id=\"gallery_link_left\" onclick=\"location.href='photos.php?pagid=$pagid'\"></div><div id=\"gallery_contents\">$contents</div><div id=\"gallery_link_right\" onclick=\"location.href='videos.php?pagid=$pagid'\"></div><div id=\"clear\"></div>";

ob_clean();
ob_start();
?>

<!-- wrapper element for the large image --> 
<div align="center">
    <!-- "previous slide" button -->
    <a class="backward"></a>

    <!-- container for the slides -->
    <div class="images">

         <?php 
            $sql = "SELECT videopath, comment FROM videos where pagid=$pagid order by ord";
            $results = $db->dbQuery($sql);
            $itemcount=0;
            while ($row = $db->dbGetRow($results)) {
                echo "<div>";
                echo "<iframe width=\"760\" height=\"430\" src=\"$row->videopath\" frameborder=\"0\" allowfullscreen></iframe>";
                echo "<p>$row->comment</p>";
                echo "</div>";
                $itemcount++;
            }
        ?>

    </div>

    <!-- "next slide" button -->
    <a class="forward"></a>

    <!-- the tabs -->
    <div class="slidetabs">
         <?php 
            for ($i=0; $i < $itemcount; $i++){
                echo "<a href=\"#\"></a>\n";
            }
        ?>
    </div>

    <script> 
        $(".slidetabs").tabs(".images > div", {

                // enable "cross-fading" effect
                effect: 'fade',
                fadeOutSpeed: "slow",

                // start from the beginning after the last tab
                rotate: true

        // use the slideshow plugin. It accepts its own configuration
        }).slideshow();    
    </script>
</div>
    
<?php
$customContents .= ob_get_clean();

$page = new LargeMasterPage($pagid,$title,$pageFound);
$page->setcustomHeadSection($customHead);
$page->setcustomMainSection($customContents);
$page->show();

?>