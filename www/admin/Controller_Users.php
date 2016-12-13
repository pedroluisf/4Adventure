<?php
require_once("../includes/class/Config.php");
require(CLASS_PATH . "Class_Users.php");
require(CLASS_PATH . "Class_Validator.php");

$task = Validator::request("task");
(bool) $status = false;
(int) $code = 0;

switch($task) {
    case "add": {
            $users = new Users();
            $users->name = Validator::request("name");
            $users->company = Validator::request("company");
            $users->email = Validator::request("email");
            $users->password = Validator::request("password");
            $users->phone = Validator::request("phone");
            $users->fax = Validator::request("fax");
            $users->country_id = Validator::request("country_id");
            $users->newsletter = Validator::request("newsletter");
            $users->preferred_lang = Validator::request("preferred_lang");
            $users->role = 'R';
            $status = $users->insert();
            $code = $users->error_no;
            break;
        }
    case "edit": {
            $users = new Users(Validator::request("uid"));
            $users->name = Validator::request("name");
            $users->company = Validator::request("company");
            $users->email = Validator::request("email");
            $users->password = Validator::request("password");
            $users->phone = Validator::request("phone");
            $users->fax = Validator::request("fax");
            $users->country_id = Validator::request("country_id");
            $users->newsletter = Validator::request("newsletter");
            $users->preferred_lang = Validator::request("preferred_lang");
            $users->role = 'R';
            $status = $users->update();
            $code = $users->error_no;
            break;
        }
    case "delete": {
            $users = new Users(Validator::request("uid"));
            $status = $users->delete();
            $code = $users->error_no;
            break;
        }
}
header("Location: users.php?status=" . $status . "&code=" . $code);
?>