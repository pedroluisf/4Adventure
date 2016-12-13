<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . 'Class_Authenticate.php');
require_once(CLASS_PATH . "Class_MasterPage.php");
require_once(CLASS_PATH . "Class_Validator.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Utilities.php");
require_once(CLASS_PATH . "Class_Pages.php");

/**
 *
 * @version
 * @author pedro
 */
session_start();
if(
    Validator::post('postback') == true &&
    Validator::isFilled('username') &&
    Validator::isFilled('password')
    ) {

    session_start();
    $username = Validator::post('username');
    $password = Validator::post('password');
    $auth = new Authenticate();
    if((bool)$auth->login($username, $password) === true) {
        header('Location:pages.php');
    }
}

ob_clean();
ob_start();
?>
<div id="formwrapper">
    <form name="loginForm" action="#" method="post">
        <input name="postback" value="true" type="hidden" />
        <div id="submitform">
            <div class="submitformtop">
                <div class="submitforml">Username</div>
                <div class="submitformr">
                    <input name="username" type="text" class="stext" />
                </div>
            </div>

            <div class="submitformtop">
                <div class="submitforml">Password</div>
                <div class="submitformr">
                    <input name="password" type="password" class="stext" />
                </div>
            </div>

            <div class="submitformbottom">
                <input type="image" src="images/okbtn.png" onmouseover="this.src='images/okbtn_hover.png'" onmouseout="this.src='images/okbtn.png'" alt="submit button" />
            </div>

        </div>
    </form>
</div>

<?php
$customContents = ob_get_clean();
$page = new MasterPage(0, "Login", 0);
$page->setcustomMainSection($customContents);
$page->setcustomThumbSection('<img src="images/profile_grupo.png" width="290px" />');
$page->show();

?>

