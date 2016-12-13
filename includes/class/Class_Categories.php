<?php
require_once("Class_Db.php");
class Categories {
/**
*@var cat_id [int] [NULLABLE: NO] [PRIMARY_KEY] [AUTO_INCREMENT]
**/
public $cat_id; 
/**
*@var cat_name [varchar] [NULLABLE: NO]  
**/
public $cat_name; 
/**
*@var error_msg Contains error messages from mysql.**/
public $error_msg; 
/**
*@var error_msg Contains error codes from mysql.**/
public $error_no; 

function __construct($cat_id=null, $cat_name=null){
$this->cat_id = ($cat_id==null) ? null : $cat_id;
$this->cat_name = ($cat_name==null) ? null : $cat_name;
}

/**
* Function to insert records into categories
* @return TRUE on success, FALSE on error.
**/
function insert() {
$db = new Db();
$sql = "INSERT INTO categories (`cat_id`, `cat_name`) VALUES (DEFAULT, '%s')";
$params = array($this->cat_name);
if(!$db->dbQuery($sql, $params)) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
return true;
}
}

/**
* Function to update records in categories
* @return TRUE on success, FALSE on error.
**/
function update() {
$db = new Db();
$sql = "UPDATE categories SET `cat_name` = '%s' WHERE `cat_id` = '%s'";
$params = array($this->cat_name, $this->cat_id);
if(!$db->dbQuery($sql, $params)) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
return true;
}
}

/**
* Function to delete records in categories
* @return TRUE on success, FALSE on error.
**/
function delete(){
$db = new Db();
$sql = "DELETE FROM categories WHERE `cat_id` = '%s'";
if(!$db->dbQuery($sql, array($this->cat_id))) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
return true;
}
}

/**
* Function to select records in categories
* @param String cat_id The key of the record to select.
* @return The results on success, FALSE on error.
**/
function select($cat_id) {
$db = new Db();
$sql = "SELECT *  FROM categories WHERE `cat_id` = '%s'";
if(!$r = $db->dbQuery($sql, array($cat_id))) {
$this->error_msg=$db->getErrorMsg();
$this->error_no=$db->getErrorNo();
return false;
} else {
$row = $db->dbGetRow($r);
$this->cat_id = $row->cat_id;
$this->cat_name = $row->cat_name;
return true;
}
}

}
?>
