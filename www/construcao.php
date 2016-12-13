<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_FrontMasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Utilities.php");
require_once(CLASS_PATH . "Class_Pages.php");

/**
 *
 * @version
 * @author pedro
 */

ob_clean();
ob_start();
?>

    <div align="center" class="main_index">
        <img src="images/construcao.jpg" alt="Em constru&ccedil;&atilde;o"/>
    </div>

<?php
$customContents = ob_get_clean();
$page = new FrontMasterPage("Em constru&ccedil;&atilde;o");
$page->setcustomMainSection($customContents);
$page->show();

?>

