<?php
/**
 * Profile page for the website.
 * @version
 * @author pedro
 */

class LargeMasterPage {
    /**
     * Page title.
     * @var String
     */
    private $_title;

    /**
     * Page id.
     * @var String
     */
    private $_pagid;

    /**
     * Show Comments.
     * @var boolean
     */
    private $_showComments;

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
    public function  __construct($pagid,$title, $showComments=1, $lang='en') {
        $this->_pagid = $pagid;
        $this->_title = $title;
        $this->_showComments = $showComments;
        $this->lang = $lang;
        $this->_customHead = "";
    }

    /**
     * Sets the title to this page.
     * @param String $title
     */
    public function setPagid($pagid) {
        $this->_pagid = $pagid;
    }

    /**
     * Gets current title.
     * @return String
     */
    public function getPagid() {
        return $this->_pagid;
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
    public function setCustomHeadSection($customHead) {
        $this->_customHead = $customHead;
    }

    /**
     * Gets current set custom head contents.
     * @return String
     */
    public function getCustomHeadSection() {
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
        ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <SCRIPT LANGUAGE="JavaScript" SRC="js/googleanalitics.js"></SCRIPT>
    <SCRIPT LANGUAGE="JavaScript" SRC="js/logomove.js"></SCRIPT> 

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $this->_title; ?></title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
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
                <div id="fb-root"><br/>&nbsp;&nbsp;
                    <script src="http://connect.facebook.net/en_US/all.js#appId=189059097810417&amp;xfbml=1"></script><fb:like href="www.4adventure.com.pt" send="true" width="450" show_faces="true" font=""></fb:like>
                </div>
            </div>
	</div>

        <div id="main_container">

            <div class="main_largepage">
                <div align="center">
                    <?php echo '<h1>' . $this->_title . '</h1><br/>'; ?>
                </div>
                <?php echo $this->_customMainSection; ?>
            </div>

            <div id="clear"></div>

        </div>
        
        <?php 
            if ($this->_showComments == 1) {
                require_once(CLASS_PATH . "commentscontainer.php");
            }
        ?>

        <div id="bottom">
        </div>

    </body>
</html>

        <?php

        $this->_page = ob_get_clean();
    }

}

?>
