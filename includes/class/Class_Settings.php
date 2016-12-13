<?php

require_once("Class_Db.php");

class Settings {

    /**
     * @var id [int] [NULLABLE: NO] [PRIMARY_KEY] [AUTO_INCREMENT]
     * */
    public $id;
    /**
     * @var company_name [varchar] [NULLABLE: YES]
     * */
    public $company_name;
    /**
     * @var company_address [varchar] [NULLABLE: YES]
     * */
    public $company_address;
    /**
     * @var admin_email [varchar] [NULLABLE: YES]
     * */
    public $admin_email;
    /**
     * @var username [varchar] [NULLABLE: NO]
     * */
    public $username;
    /**
     * @var password [varchar] [NULLABLE: NO]
     * */
    public $password;
    /**
     * @var company_phone [varchar] [NULLABLE: YES]
     * */
    public $company_phone;
    /**
     * @var company_fax [varchar] [NULLABLE: YES]
     * */
    public $company_fax;
    /**
     * @var company_mobile [varchar] [NULLABLE: YES]
     * */
    public $company_mobile;
    /**
     * @var company_email [varchar] [NULLABLE: YES]
     * */
    public $company_email;
    /**
     * @var error_msg Contains error messages from mysql.* */
    public $error_msg;
    /**
     * @var error_msg Contains error codes from mysql.* */
    public $error_no;

    function __construct($id=null, $company_name=null, $company_address=null, $admin_email=null, $username=null, $password=null, $company_phone=null, $company_fax=null, $company_mobile=null, $company_email=null) {
        $this->id = ($id == null) ? null : $id;
        $this->company_name = ($company_name == null) ? null : $company_name;
        $this->company_address = ($company_address == null) ? null : $company_address;
        $this->admin_email = ($admin_email == null) ? null : $admin_email;
        $this->username = ($username == null) ? null : $username;
        $this->password = ($password == null) ? null : $password;
        $this->company_phone = ($company_phone == null) ? null : $company_phone;
        $this->company_fax = ($company_fax == null) ? null : $company_fax;
        $this->company_mobile = ($company_mobile == null) ? null : $company_mobile;
        $this->company_email = ($company_email == null) ? null : $company_email;
    }

    /**
     * Function to insert records into settings
     * @return TRUE on success, FALSE on error.
     * */
    function insert() {
        $db = new Db();
        $sql = "INSERT INTO settings (`id`, `company_name`, `company_address`, `admin_email`, `username`, `password`, `company_phone`, `company_fax`, `company_mobile`, `company_email`) VALUES (DEFAULT, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";
        $params = array($this->company_name, $this->company_address, $this->admin_email, $this->username, $this->password, $this->company_phone, $this->company_fax, $this->company_mobile, $this->company_email);
        if (!$db->dbQuery($sql, $params)) {
            $this->error_msg = $db->getErrorMsg();
            $this->error_no = $db->getErrorNo();
            return false;
        } else {
            return true;
        }
    }

    /**
     * Function to update records in settings
     * @return TRUE on success, FALSE on error.
     * */
    function update() {
        $db = new Db();
        $sql = "UPDATE settings SET `company_name` = '%s', `company_address` = '%s', `admin_email` = '%s', `username` = '%s', `password` = '%s', `company_phone` = '%s', `company_fax` = '%s', `company_mobile` = '%s', `company_email` = '%s' WHERE `id` = '%s'";
        $params = array($this->company_name, $this->company_address, $this->admin_email, $this->username, $this->password, $this->company_phone, $this->company_fax, $this->company_mobile, $this->company_email, $this->id);
        if (!$db->dbQuery($sql, $params)) {
            $this->error_msg = $db->getErrorMsg();
            $this->error_no = $db->getErrorNo();
            return false;
        } else {
            return true;
        }
    }

    /**
     * Function to delete records in settings
     * @return TRUE on success, FALSE on error.
     * */
    function delete() {
        $db = new Db();
        $sql = "DELETE FROM settings WHERE `id` = '%s'";
        if (!$db->dbQuery($sql, array($this->id))) {
            $this->error_msg = $db->getErrorMsg();
            $this->error_no = $db->getErrorNo();
            return false;
        } else {
            return true;
        }
    }

    /**
     * Function to select records in settings
     * @param String id The key of the record to select.
     * @return The results on success, FALSE on error.
     * */
    function select($id) {
        $db = new Db();
        $sql = "SELECT *  FROM settings WHERE `id` = '%s'";
        if (!$r = $db->dbQuery($sql, array($id))) {
            $this->error_msg = $db->getErrorMsg();
            $this->error_no = $db->getErrorNo();
            return false;
        } else {
            $row = $db->dbGetRow($r);
            $this->id = $row->id;
            $this->company_name = $row->company_name;
            $this->company_address = $row->company_address;
            $this->admin_email = $row->admin_email;
            $this->username = $row->username;
            $this->password = $row->password;
            $this->company_phone = $row->company_phone;
            $this->company_fax = $row->company_fax;
            $this->company_mobile = $row->company_mobile;
            $this->company_email = $row->company_email;
            return true;
        }
    }

}
?>
