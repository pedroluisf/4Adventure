<?php
require_once("Class_Db.php");
class Countries {
    /**
     *@var cntid [int] [NULLABLE: NO] [PRIMARY_KEY] [AUTO_INCREMENT]
     **/
    public $cntid;
    /**
     *@var country_name [varchar] [NULLABLE: NO]
     **/
    public $country_name;
    /**
     *@var country_code [varchar] [NULLABLE: NO]
     **/
    public $country_code;
    /**
     *@var error_msg Contains error messages from mysql.**/
    public $error_msg;
    /**
     *@var error_msg Contains error codes from mysql.**/
    public $error_no;

    function __construct($cntid=null, $country_name=null, $country_code=null) {
        $this->cntid = ($cntid==null) ? null : $cntid;
        $this->country_name = ($country_name==null) ? null : $country_name;
        $this->country_code = ($country_code==null) ? null : $country_code;
    }

    /**
     * Function to insert records into countries
     * @return TRUE on success, FALSE on error.
     **/
    function insert() {
        $db = new Db();
        $sql = "INSERT INTO countries (`cntid`, `country_name`, `country_code`) VALUES (DEFAULT, '%s', '%s')";
        $params = array($this->country_name, $this->country_code);
        if(!$db->dbQuery($sql, $params)) {
            $this->error_msg=$db->getErrorMsg();
            $this->error_no=$db->getErrorNo();
            return false;
        } else {
            return true;
        }
    }

    /**
     * Function to update records in countries
     * @return TRUE on success, FALSE on error.
     **/
    function update() {
        $db = new Db();
        $sql = "UPDATE countries SET `country_name` = '%s', `country_code` = '%s' WHERE `cntid` = '%s'";
        $params = array($this->country_name, $this->country_code, $this->cntid);
        if(!$db->dbQuery($sql, $params)) {
            $this->error_msg=$db->getErrorMsg();
            $this->error_no=$db->getErrorNo();
            return false;
        } else {
            return true;
        }
    }

    /**
     * Function to delete records in countries
     * @return TRUE on success, FALSE on error.
     **/
    function delete() {
        $db = new Db();
        $sql = "DELETE FROM countries WHERE `cntid` = '%s'";
        if(!$db->dbQuery($sql, array($this->cntid))) {
            $this->error_msg=$db->getErrorMsg();
            $this->error_no=$db->getErrorNo();
            return false;
        } else {
            return true;
        }
    }

    /**
     * Function to select records in countries
     * @param String cntid The key of the record to select.
     * @return The results on success, FALSE on error.
     **/
    function select($cntid) {
        $db = new Db();
        $sql = "SELECT *  FROM countries WHERE `cntid` = '%s'";
        if(!$r = $db->dbQuery($sql, array($cntid))) {
            $this->error_msg=$db->getErrorMsg();
            $this->error_no=$db->getErrorNo();
            return false;
        } else {
            $row = $db->dbGetRow($r);
            $this->cntid = $row->cntid;
            $this->country_name = $row->country_name;
            $this->country_code = $row->country_code;
            return true;
        }
    }

}
?>
