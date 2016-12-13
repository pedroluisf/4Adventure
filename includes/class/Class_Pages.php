<?php
require_once("Class_Db.php");
class Pages {
/**
*@var pagid [int] [NULLABLE: NO] [PRIMARY_KEY] [AUTO_INCREMENT]
**/
public $pagid; 
/**
*@var catid [int] [NULLABLE: YES]
**/
public $catid;
/**
*@var title [varchar] [NULLABLE: NO]  
**/
public $title; 
/**
*@var contents [text] [NULLABLE: YES]  
**/
public $contents; 
/**
*@var lastupdate [datetime] [NULLABLE: YES]  
**/
public $lastupdate; 
/**
*@var url [varchar] [NULLABLE: NO]  
**/
public $url; 
/**
*@var thumb [varchar] [NULLABLE: YES]
**/
public $thumb;
/**
*@var datepost [datetime] [NULLABLE: YES]
**/
public $datepost;
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

function __construct($pagid=null, $catid=null, $title=null, $contents=null, $lastupdate=null, $url=null, $thumb=null, $datepost=null, $lang=null){
$this->pagid = ($pagid==null) ? null : $pagid;
$this->catid = ($catid==null) ? null : $catid;
$this->title = ($title==null) ? null : $title;
$this->contents = ($contents==null) ? null : $contents;
$this->lastupdate = ($lastupdate==null) ? null : $lastupdate;
$this->url = ($url==null) ? null : $url;
$this->thumb = ($thumb==null) ? null : $thumb;
$this->datepost = ($datepost==null) ? null : $datepost;
$this->lang = ($lang==null) ? null : $lang;
}

/**
* Function to insert records into pages
* @return TRUE on success, FALSE on error.
**/
function insert() {
$db = new Db();
$this->lastupdate = date('Y-m-d h:i');
$sql = "INSERT INTO pages (`pagid`, `catid`, `title`, `contents`, `lastupdate`, `url`, `thumb`, `lang`, `datepost`) VALUES (DEFAULT, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";
$params = array($this->catid, $this->title, $this->contents, $this->lastupdate, $this->url, $this->thumb, $this->lang, $this->datepost);
if(!$db->dbQuery($sql, $params)) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
return true;
}
}

/**
* Function to update records in pages
* @return TRUE on success, FALSE on error.
**/
function update() {
$db = new Db();
$this->lastupdate = date('Y-m-d h:i');
$sql = "UPDATE pages SET `catid` = '%s', `title` = '%s', `contents` = '%s', `lastupdate` = '%s', `url` = '%s', `thumb` = '%s', `lang` = '%s', `datepost` = '%s' WHERE `pagid` = '%s'";
$params = array($this->catid, $this->title, $this->contents, $this->lastupdate, $this->url, $this->thumb, $this->lang, $this->datepost, $this->pagid);
if(!$db->dbQuery($sql, $params)) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
return true;
}
}

/**
* Function to delete records in pages
* @return TRUE on success, FALSE on error.
**/
function delete(){
$db = new Db();
$sql = "DELETE FROM pages WHERE `pagid` = '%s'";
if(!$db->dbQuery($sql, array($this->pagid))) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
return true;
}
}

/**
* Function to select records in pages
* @param String pagid The key of the record to select.
* @return The results on success, FALSE on error.
**/
function select($pagid) {
$db = new Db();
$sql = "SELECT *  FROM pages WHERE `pagid` = '%s'";
if(!$r = $db->dbQuery($sql, array($pagid))) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
$row = $db->dbGetRow($r);
$this->pagid = $row->pagid;
$this->catid = $row->catid;
$this->title = $row->title;
$this->contents = $row->contents;
$this->lastupdate = $row->lastupdate;
$this->url = $row->url;
$this->thumb = $row->thumb;
$this->lang = $row->lang;
$this->datepost = $row->datepost;
return true;
}
}

}
?>
