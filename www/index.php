<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_FrontMasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Utilities.php");

/**
 *
 * @version
 * @author pedro
 */

ob_clean();
ob_start();
?>

    <img src="images/group_main.png" alt="Os 4 personagens"/>

<?php
$customContents = ob_get_clean();
$page = new FrontMasterPage("4Adventure - Relatos de aventuras de 4 amigos sobre duas rodas");
$page->setcustomMainSection($customContents);
$page->show();

?>

