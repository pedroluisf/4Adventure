<?php
require_once("../includes/class/Config.php");
require(CLASS_PATH . "Class_Settings.php");
require(CLASS_PATH . "Class_Validator.php");

$task = Validator::request("task");
(bool) $status = false;
(int) $code = 0;

switch($task) {
    case "add": {
            $settings = new Settings();
            $settings->company_name = Validator::request("company_name");
            $settings->company_address = Validator::request("company_address");
            $settings->admin_email = Validator::request("admin_email");
            $settings->username = Validator::request("username");
            $settings->password = Validator::request("password");
            $settings->company_phone = Validator::request("company_phone");
            $settings->company_fax = Validator::request("company_fax");
            $settings->company_mobile = Validator::request("company_mobile");
            $settings->company_email = Validator::request("company_email");
            $status = $settings->insert();
            $code = $settings->error_no;
            break;
        }
    case "edit": {
            $settings = new Settings(Validator::request("id"));
            $settings->company_name = Validator::request("company_name");
            $settings->company_address = Validator::request("company_address");
            $settings->admin_email = Validator::request("admin_email");
            $settings->username = Validator::request("username");
            $settings->password = Validator::request("password");
            $settings->company_phone = Validator::request("company_phone");
            $settings->company_fax = Validator::request("company_fax");
            $settings->company_mobile = Validator::request("company_mobile");
            $settings->company_email = Validator::request("company_email");
            $status = $settings->update();
            $code = $settings->error_no;
            break;
        }
    case "delete": {
            $settings = new Settings(Validator::request("id"));
            $status = $settings->delete();
            $code = $settings->error_no;
            break;
        }
}
header("Location: settings.php?status=" . $status . "&code=" . $code);
?>