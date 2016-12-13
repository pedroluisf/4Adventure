<?php
require_once('Config.php');
require_once(CLASS_PATH . 'Class_Db.php');
require_once(CLASS_PATH . 'Class_Validator.php');
/**
 *
 * @version 1
 * @author pedro
 */

class Authenticate {
    private $username;
    private $password;
    private $sessionId;
    private $isLoggedIn;

    public function  __construct($username=null, $password=null, $sessionId=null) {
        $this->username = ($username == null) ? "" : $username;
        $this->password = ($password == null) ? "" : $password;
        $this->sessionId = ($sessionId == null) ? "" : $sessionId;
        $this->isLoggedIn = false;
    }

    public function login($username, $password) {
        $db = new Db();
        $password = md5($password);

        if(Validator::isFilled($username) && Validator::isFilled($password)) {
            $sql = "SELECT * FROM `users` WHERE `username` = '%s' AND `password` = '%s'";
            $params = array($username, $password);
            $results = $db->dbQuery($sql, $params);
            if($db->nRows($results) > 0) {
                $user = $db->dbGetRow($results);
                $this->setSessionVariables(
                    array(
                    NAME_SPACE . '_name' => $user->name,
                    NAME_SPACE . '_role' => $user->role,
                    NAME_SPACE . '_isLoggedIn' => true
                    )
                );

                return true;
            }
        }

        return false;
    }

    public function logout() {
        if(isset ($_SESSION)) {
        session_destroy();
        session_unset();
        unset($_SESSION);
        }

        $this->username = "";
        $this->password = "";
        $this->sessionId = "";
        $this->isLoggedIn = false;
    }

    private function setSessionVariables($args) {
        if(is_array($args)) {
            foreach ($args as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }
    }

}
?>