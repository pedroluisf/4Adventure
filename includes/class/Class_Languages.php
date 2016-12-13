<?php
require_once("Class_Db.php");
class Languages {
/**
*@var langid [int] [NULLABLE: NO] [PRIMARY_KEY] [AUTO_INCREMENT]
**/
public $langid; 
/**
*@var language [varchar] [NULLABLE: NO]  
**/
public $language; 
/**
*@var error_msg Contains error messages from mysql.**/
public $error_msg; 
/**
*@var error_msg Contains error codes from mysql.**/
public $error_no; 

function __construct($langid=null, $language=null){
$this->langid = ($langid==null) ? null : $langid;
$this->language = ($language==null) ? null : $language;
}

/**
* Function to insert records into languages
* @return TRUE on success, FALSE on error.
**/
function insert() {
$db = new Db();
$sql = "INSERT INTO languages (`langid`, `language`) VALUES (DEFAULT, '%s')";
$params = array($this->language);
if(!$db->dbQuery($sql, $params)) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
return true;
}
}

/**
* Function to update records in languages
* @return TRUE on success, FALSE on error.
**/
function update() {
$db = new Db();
$sql = "UPDATE languages SET `language` = '%s' WHERE `langid` = '%s'";
$params = array($this->language, $this->langid);
if(!$db->dbQuery($sql, $params)) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
return true;
}
}

/**
* Function to delete records in languages
* @return TRUE on success, FALSE on error.
**/
function delete(){
$db = new Db();
$sql = "DELETE FROM languages WHERE `langid` = '%s'";
if(!$db->dbQuery($sql, array($this->langid))) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
return true;
}
}

/**
* Function to select records in languages
* @param String langid The key of the record to select.
* @return The results on success, FALSE on error.
**/
function select($langid) {
$db = new Db();
$sql = "SELECT *  FROM languages WHERE `langid` = '%s'";
if(!$r = $db->dbQuery($sql, array($langid))) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
$row = $db->dbGetRow($r);
$this->langid = $row->langid;
$this->language = $row->language;
return true;
}
}

}
?>
