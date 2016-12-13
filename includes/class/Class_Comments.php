<?php

require_once("Class_Db.php");

class Comments {

    /**
     * @var comid [int] [NULLABLE: NO] [PRIMARY_KEY] [AUTO_INCREMENT]
     * */
    public $comid;
    /**
     * @var name [varchar] [NULLABLE: NO]
     * */
    public $pagid;
    /**
     * @var pagid [int] [NULLABLE: NO] 
     * */
    public $name;
    /**
     * @var comment [varchar] [NULLABLE: NO]
     * */
    public $comment;
    /**
     * @var lastupdate [varchar] [NULLABLE: NO]
     * */
    public $lastupdate;
    /**
     * @var error_msg Contains error messages from mysql.* */
    public $error_msg;
    /**
     * @var error_msg Contains error codes from mysql.* */
    public $error_no;

    function __construct($comid=null, $pagid=null, $name=null, $comment=null, $lastupdate=null) {
        $this->comid = ($comid == null) ? null : $comid;
        $this->pagid = ($pagid == null) ? null : $pagid;
        $this->name = ($name == null) ? null : $name;
        $this->comment = ($comment == null) ? null : $comment;
        $this->lastupdate = ($lastupdate == null) ? null : $lastupdate;
    }

    /**
     * Function to insert records into comments
     * @return TRUE on success, FALSE on error.
     * */
    function insert() {
        $db = new Db();
        $sql = "INSERT INTO comments (`comid`, `pagid`, `name`, `comment`, `lastupdate`) VALUES (DEFAULT, %s, '%s', '%s', now())";
        $params = array($this->pagid, $this->name, $this->comment);
        if (!$db->dbQuery($sql, $params)) {
            $this->error_msg = $db->getErrorMsg();
            $this->error_no = $db->getErrorNo();
            echo $this->error_msg;
            return false;
        } else {
            return true;
        }
    }

    /**
     * Function to update records in comments
     * @return TRUE on success, FALSE on error.
     * */
    function update() {
        $db = new Db();
        $sql = "UPDATE comments SET `name` = '%s', `comment` = '%s', `lastupdate` = now()";
        $params = array($this->name, $this->comment, $this->comid);
        if (!$db->dbQuery($sql, $params)) {
            $this->error_msg = $db->getErrorMsg();
            $this->error_no = $db->getErrorNo();
            return false;
        } else {
            return true;
        }
    }

    /**
     * Function to delete records in comments
     * @return TRUE on success, FALSE on error.
     * */
    function delete() {
        $db = new Db();
        $sql = "DELETE FROM comments WHERE `comid` = '%s'";
        if (!$db->dbQuery($sql, array($this->comid))) {
            $this->error_msg = $db->getErrorMsg();
            $this->error_no = $db->getErrorNo();
            return false;
        } else {
            return true;
        }
    }

    /**
     * Function to select records in comments
     * @param String comid The key of the record to select.
     * @return The results on success, FALSE on error.
     * */
    function select($comid) {
        $db = new Db();
        $sql = "SELECT *  FROM comments WHERE `comid` = '%s'";
        if (!$r = $db->dbQuery($sql, array($comid))) {
            $this->error_msg = $db->getErrorMsg();
            $this->error_no = $db->getErrorNo();
            return false;
        } else {
            $row = $db->dbGetRow($r);
            $this->comid = $row->comid;
            $this->pagid = $row->pagid;
            $this->name = $row->name;
            $this->comment = $row->comment;
            $this->lastupdate = $row->lastupdate;
            return true;
        }
    }

}

?>
