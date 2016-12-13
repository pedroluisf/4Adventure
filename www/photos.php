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
        $title=$row->title . ' - Fotos';
        $thumb=$row->thumb;
        $contents=$row->contents;
    }    
} 

if ($pageFound == 0) {
    header('Location:galeria.php');
}
    
$customHead .= '<link href="css/comments.css" rel="stylesheet" type="text/css" />' . "\n";
$customHead .= '<link href="css/jqgallery.css" rel="stylesheet" type="text/css" />';
$customHead .= '<script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>';

$customContents = "<div id=\"gallery_link_left\" onclick=\"location.href='photos.php?pagid=$pagid'\"></div><div id=\"gallery_contents\">$contents</div><div id=\"gallery_link_right\" onclick=\"location.href='videos.php?pagid=$pagid'\"></div><div id=\"clear\"></div>";

ob_clean();
ob_start();
?>

<!-- wrapper element for the large image --> 
<div align="center">
    <div id="image_wrap"> 

            <!-- Initially the image is a simple 1x1 pixel transparent GIF --> 
            <img src="http://static.flowplayer.org/tools/img/blank.gif" width="750" height="562" /> 

    </div> 


    <!-- HTML structures --> 

    <!-- "previous page" action --> 
    <a class="prev browse left"></a> 

    <!-- root element for scrollable --> 
    <div class="scrollable">   

       <!-- root element for the items --> 
       <div class="items"> 

           <?php 
            $sql = "SELECT imagepath, comment FROM photos where pagid=$pagid order by ord ";
            $results = $db->dbQuery($sql);
            $itemcount=0;
            while ($row = $db->dbGetRow($results)) {
                if ($itemcount%5==0) echo "<div>\n";
                $itemcount++;
                if (Utilities::left($row->imagepath, 4) != 'http'){
                    $image = Utilities::image2thumb($row->imagepath);
                } else {
                    $image = $row->imagepath;                    
                }
                echo "<img src=\"$image\" />\n";
                if (($itemcount%5)==0) {
                    echo "</div>\n";
                }
            }
            if ($itemcount > 5) {
                echo "</div>\n";
            }
          ?>

       </div> 

    </div> 

    <!-- "next page" action --> 
    <a class="next browse right"></a> 

    <script> 
    $(function() {

    $(".scrollable").scrollable();

    $(".items img").click(function() {

            // see if same thumb is being clicked
            if ($(this).hasClass("active")) { return; }

            // calclulate large image's URL based on the thumbnail URL (flickr specific)
            if ($(this).attr("src").substr(0, 7).toLowerCase() != 'http://' && $(this).attr("src").substr(0, 8).toLowerCase() != 'https://'){
                var url = $(this).attr("src").replace("_t", "");
            } else {
                var url = $(this).attr("src").toString();
            }

            // get handle to element that wraps the image and make it semi-transparent
            var wrap = $("#image_wrap").fadeTo("medium", 0.5);

            // the large image from www.flickr.com
            var img = new Image();


            // call this function after it's loaded
            img.onload = function() {

                    // make wrapper fully visible
                    wrap.fadeTo("fast", 1);

                    // change the image
                    wrap.find("img").attr("src", url);

            };

            // begin loading the image from www.flickr.com
            img.src = url;

            // activate item
            $(".items img").removeClass("active");
            $(this).addClass("active");

    // when page loads simulate a "click" on the first image
    }).filter(":first").click();
    });
    </script>
</div>
    
<?php
$customContents .= ob_get_clean();

$page = new LargeMasterPage($pagid,$title,$pageFound);
$page->setcustomHeadSection($customHead);
$page->setcustomMainSection($customContents);
$page->show();

?>