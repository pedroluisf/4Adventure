<?php

ob_clean();
ob_start();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<SCRIPT LANGUAGE="JavaScript" SRC="js/googleanalitics.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="js/logomove.js"></SCRIPT>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="header">
</div>
<div id="menu">
    <div class="top_left">
        <div id="logo" onMouseOver="logoover();" onMouseOut="logoout();"><a href="index.php"><img id="logotipo" src="images/logo.png" alt="Logotipo"/></a></div>
    </div>

</div>

<div id="main_container">


</div>

<div id="bottom"></div>

</body>
</html>


<?php

$content = ob_get_clean();
//echo htmlentities( $content , ENT_QUOTES, "UTF-8");

print_r($content);
echo "\r\nENC2: " . mb_detect_encoding($content) . "\r\n\r\n" ;
echo htmlentities( "øæå jeść ясть" ) . "\r\n\r\n" ;
echo htmlentities( "øæå jeść ясть", ENT_QUOTES, "UTF-8") . "\r\n\r\n" ;

?>

<?php
////require_once("../includes/class/Config.php");
////require_once(CLASS_PATH . "Class_FrontMasterPage.php");
////require_once(CLASS_PATH . "Class_Db.php");
////require_once(CLASS_PATH . "Class_Utilities.php");
////
//
//
//
///**
// *
// * @version
// * @author pedro
// */
//
//ob_clean();
//ob_start();
//?>
<!---->
<!--    <img src="images/group_main.png" alt="Os 4 personagens"/>-->
<!---->
<?php
//$customContents = ob_get_clean();
//$page = new FrontMasterPage("4Adventure - Relatos de aventuras de 4 amigos sobre duas rodas");
//$page->setcustomMainSection($customContents);
//$page->show();
//
//?>
<!---->
