<?php
/**
* 
* @version 2
* @author pedro
*/

// Mysql
define("MYSQL_HOST", "localhost");
define("MYSQL_PORT", "3306");
define("MYSQL_DB", "4adventure");
define("MYSQL_USER", "root");
define("MYSQL_PWD", "");


// Directories
//define("ROOT", "/home/pg20511/public_html");
define("ROOT", __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
define("UPLOAD_PATH", ROOT . "uploads" . DIRECTORY_SEPARATOR);
define("CLASS_PATH", ROOT . "includes" . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR);
define("NAME_SPACE", "4Adventure");

// Php
define("DEBUG_MSG", "1"); // 0 - off, 1 - on

// Application
define("ONLINE", "1"); // 0 - off, 1 - on
?>
