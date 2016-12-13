<?php

require_once("Class_Db.php");

class Users {

    /**
     * @var uid [int] [NULLABLE: NO] [PRIMARY_KEY] [AUTO_INCREMENT]
     * */
    public $uid;
    /**
     * @var name [varchar] [NULLABLE: NO]  
     * */
    public $name;
    /**
     * @var company [varchar] [NULLABLE: NO]
     * */
    public $company;
    /**
     * @var email [varchar] [NULLABLE: NO]  
     * */
    public $email;
    /**
     * @var password [varchar] [NULLABLE: NO]
     * */
    public $password;
    /**
     * @var phone [varchar] [NULLABLE: YES]  
     * */
    public $phone;
    /**
     * @var fax [varchar] [NULLABLE: YES]
     * */
    public $fax;
    /**
     * @var country_id [int] [NULLABLE: NO]  
     * */
    public $country_id;
    /**
     * @var newsletter [enum] [NULLABLE: NO]
     * */
    public $newsletter;
    /**
     * @var preferred_lang [int] [NULLABLE: NO]  
     * */
    public $preferred_lang;
    /**
     * @var username [varchar] [NULLABLE: NO]
     * */
    public $username;
    /**
     * @var role [enum] [NULLABLE: NO]  
     * */
    public $role;
    /**
     * @var error_msg Contains error messages from mysql.* */
    public $error_msg;
    /**
     * @var error_msg Contains error codes from mysql.* */
    public $error_no;

    function __construct($uid=null, $name=null, $company=null, $email=null, $password=null, $phone=null, $fax=null, $country_id=null, $newsletter=null, $preferred_lang=null, $username=null, $role=null) {
        $this->uid = ($uid == null) ? null : $uid;
        $this->name = ($name == null) ? null : $name;
        $this->company = ($company == null) ? null : $company;
        $this->email = ($email == null) ? null : $email;
        $this->password = ($password == null) ? null : $password;
        $this->phone = ($phone == null) ? null : $phone;
        $this->fax = ($fax == null) ? null : $fax;
        $this->country_id = ($country_id == null) ? null : $country_id;
        $this->newsletter = ($newsletter == null) ? null : $newsletter;
        $this->preferred_lang = ($preferred_lang == null) ? null : $preferred_lang;
        $this->username = ($username == null) ? null : $username;
        $this->role = ($role == null) ? null : $role;
    }

    /**
     * Function to insert records into users
     * @return TRUE on success, FALSE on error.
     * */
    function insert() {
        $db = new Db();
        $sql = "INSERT INTO users (`uid`, `name`, `company`, `email`, `password`, `phone`, `fax`, `country_id`, `newsletter`, `preferred_lang`, `username`, `role`) VALUES (DEFAULT, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";
        $params = array($this->name, $this->company, $this->email, $this->password, $this->phone, $this->fax, $this->country_id, $this->newsletter, $this->preferred_lang, $this->username, $this->role);
        if (!$db->dbQuery($sql, $params)) {
            $this->error_msg = $db->getErrorMsg();
            $this->error_no = $db->getErrorNo();
            return false;
        } else {
            return true;
        }
    }

    /**
     * Function to update records in users
     * @return TRUE on success, FALSE on error.
     * */
    function update() {
        $db = new Db();
        $sql = "UPDATE users SET `name` = '%s', `company` = '%s', `email` = '%s', `password` = '%s', `phone` = '%s', `fax` = '%s', `country_id` = '%s', `newsletter` = '%s', `preferred_lang` = '%s', `username` = '%s', `role` = '%s' WHERE `uid` = '%s'";
        $params = array($this->name, $this->company, $this->email, $this->password, $this->phone, $this->fax, $this->country_id, $this->newsletter, $this->preferred_lang, $this->username, $this->role, $this->uid);
        if (!$db->dbQuery($sql, $params)) {
            $this->error_msg = $db->getErrorMsg();
            $this->error_no = $db->getErrorNo();
            return false;
        } else {
            return true;
        }
    }

    /**
     * Function to delete records in users
     * @return TRUE on success, FALSE on error.
     * */
    function delete() {
        $db = new Db();
        $sql = "DELETE FROM users WHERE `uid` = '%s'";
        if (!$db->dbQuery($sql, array($this->uid))) {
            $this->error_msg = $db->getErrorMsg();
            $this->error_no = $db->getErrorNo();
            return false;
        } else {
            return true;
        }
    }

    /**
     * Function to select records in users
     * @param String uid The key of the record to select.
     * @return The results on success, FALSE on error.
     * */
    function select($uid) {
        $db = new Db();
        $sql = "SELECT *  FROM users WHERE `uid` = '%s'";
        if (!$r = $db->dbQuery($sql, array($uid))) {
            $this->error_msg = $db->getErrorMsg();
            $this->error_no = $db->getErrorNo();
            return false;
        } else {
            $row = $db->dbGetRow($r);
            $this->uid = $row->uid;
            $this->name = $row->name;
            $this->company = $row->company;
            $this->email = $row->email;
            $this->password = $row->password;
            $this->phone = $row->phone;
            $this->fax = $row->fax;
            $this->country_id = $row->country_id;
            $this->newsletter = $row->newsletter;
            $this->preferred_lang = $row->preferred_lang;
            $this->username = $row->username;
            $this->role = $row->role;
            return true;
        }
    }

}

?>
