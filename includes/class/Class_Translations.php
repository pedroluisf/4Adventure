<?php
require_once("Class_Db.php");
class Translations {
/**
*@var trnid [int] [NULLABLE: NO] [PRIMARY_KEY] 
**/
public $trnid; 
/**
*@var keyword [varchar] [NULLABLE: NO]  
**/
public $keyword; 
/**
*@var translation [varchar] [NULLABLE: NO]  
**/
public $translation; 
/**
*@var lang [int] [NULLABLE: NO]  
**/
public $lang; 
/**
*@var error_msg Contains error messages from mysql.**/
public $error_msg; 
/**
*@var error_msg Contains error codes from mysql.**/
public $error_no; 

function __construct($trnid=null, $keyword=null, $translation=null, $lang=null){
$this->trnid = ($trnid==null) ? null : $trnid;
$this->keyword = ($keyword==null) ? null : $keyword;
$this->translation = ($translation==null) ? null : $translation;
$this->lang = ($lang==null) ? null : $lang;
}

/**
* Function to insert records into translations
* @return TRUE on success, FALSE on error.
**/
function insert() {
$db = new Db();
$sql = "INSERT INTO translations (`trnid`, `keyword`, `translation`, `lang`) VALUES ('%s', '%s', '%s', '%s')";
$params = array($this->trnid, $this->keyword, $this->translation, $this->lang);
if(!$db->dbQuery($sql, $params)) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
return true;
}
}

/**
* Function to update records in translations
* @return TRUE on success, FALSE on error.
**/
function update() {
$db = new Db();
$sql = "UPDATE translations SET `trnid` = '%s', `keyword` = '%s', `translation` = '%s', `lang` = '%s' WHERE `trnid` = '%s'";
$params = array($this->trnid, $this->keyword, $this->translation, $this->lang, $this->trnid);
if(!$db->dbQuery($sql, $params)) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
return true;
}
}

/**
* Function to delete records in translations
* @return TRUE on success, FALSE on error.
**/
function delete(){
$db = new Db();
$sql = "DELETE FROM translations WHERE `trnid` = '%s'";
if(!$db->dbQuery($sql, array($this->trnid))) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
return true;
}
}

/**
* Function to select records in translations
* @param String trnid The key of the record to select.
* @return The results on success, FALSE on error.
**/
function select($trnid) {
$db = new Db();
$sql = "SELECT *  FROM translations WHERE `trnid` = '%s'";
if(!$r = $db->dbQuery($sql, array($trnid))) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
$row = $db->dbGetRow($r);
$this->trnid = $row->trnid;
$this->keyword = $row->keyword;
$this->translation = $row->translation;
$this->lang = $row->lang;
return true;
}
}

}
?>
