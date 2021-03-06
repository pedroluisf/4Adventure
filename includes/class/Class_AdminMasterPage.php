<?php
require_once 'Config.php';
require_once 'Class_Validator.php';
/**
 * Master front page for the website.
 * @version
 * @author pedro
 */

class AdminMasterPage {
    /**
     * Page title.
     * @var String
     */
    private $_title;

    /**
     * Buffered page.
     * @var String
     */
    private $_page;

    /**
     * Custom page Head section.
     * @var String
     */
    private $_customHead;

    /**
     * Custom page main section.
     * @var String
     */
    private $_customMainSection;

    /**
     * Page language.
     * @var String
     */
    private $_lang;

    /**
     * Creates a new instance of MasterPage.
     * @param String $title The title for the page.
     */
    public function  __construct($title, $lang='pt') {
        $this->_title = $title;
        $this->lang = $lang;
        $this->_customHead = "";
    }

    /**
     * Sets the title to this page.
     * @param String $title
     */
    public function setTitle($title) {
        $this->_title = $title;
    }

    /**
     * Gets current title.
     * @return String
     */
    public function getTitle() {
        return $this->_title;
    }

    /**
     * Sets the custom part of the head section on this page.
     * @param String $customHead The custom part of the head in the page.
     */
    public function setCustomHead($customHead) {
        $this->_customHead = $customHead;
    }

    /**
     * Gets current set custom head contents.
     * @return String
     */
    public function getCustomHead() {
        return $this->_customHead;
    }

    /**
     * Sets the custom main part on this page.
     * @param String $customMainSection The custom part of the main part on the page.
     */
    public function setcustomMainSection($customMainSection) {
        $this->_customMainSection = $customMainSection;
    }

    /**
     * Gets current set custom main left contents.
     * @return String
     */
    public function getCustomMainSection() {
        return $this->_customMainSection;
    }

    /**
     * Display the buffered page.
     */
    public function show() {
        $this->buildPage();
        echo $this->_page;
    }

    /**
     * Get's the current page contents.
     * @return String The current page.
     */
    public function getPage() {
        return $this->_page;
    }

    /**
     * Buffer the page, using current custom content.
     */
    private function buildPage() {
        ob_clean();
        ob_start();

        session_start();
        $logged = Validator::session(NAME_SPACE . '_isLoggedIn');
        $role = Validator::session(NAME_SPACE . '_role');
        if($logged != 1 || $role != 'A') {
            header('Location:login.php');
        }
        ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN\" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <SCRIPT LANGUAGE="JavaScript" SRC="js/googleanalitics.js"></SCRIPT>
    <SCRIPT LANGUAGE="JavaScript" SRC="js/logomove.js"></SCRIPT>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $this->_title; ?></title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/gt-styles.css" type="text/css" media="screen, projection" />
        <?php echo $this->_customHead; ?>
    </head>

    <body>

        <div id="header">
	</div>
        <div id="menu">
            <div class="top_left">
                <div id="logo" onMouseOver="logoover();" onMouseOut="logoout();"><a href="index.php"><img id="logotipo" src="images/logo.png" alt="Logotipo"/></a></div>
            </div>

            <div class="top_menu">
                <?php require_once(CLASS_PATH . "FrontMainMenu.php"); ?>
                <div style="float: right; padding-right: 50px;">Bem vindo <?php echo Validator::session(NAME_SPACE . '_name'); ?>&nbsp;<a href="logout.php">logout</a></div>
                <div id="fb-root"><br/>&nbsp;&nbsp;
                    <script src="http://connect.facebook.net/en_US/all.js#appId=189059097810417&amp;xfbml=1"></script><fb:like href="www.4adventure.com.pt" send="true" width="450" show_faces="true" font=""></fb:like>
                </div>
            </div>
	</div>

        <div id="main_container">

            <div class="main_admin_page">
                <?php echo $this->_customMainSection; ?>
            </div>

            <div id="clear"></div>

        </div>

        <div id="bottom">
        </div>

    </body>
</html>

        <?php

        $this->_page = ob_get_clean();
    }

}

?>
