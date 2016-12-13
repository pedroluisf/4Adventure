<?php
require_once("../includes/class/Config.php");
require(CLASS_PATH . "Class_Categories.php");
require(CLASS_PATH . "Class_Validator.php");

$task = Validator::request("task");
(bool) $status = false;
(int) $code = 0;

switch($task) {
    case "add": {
            $categories = new Categories();
            $categories->cat_name = Validator::request("cat_name");
            $status = $categories->insert();
            $code = $categories->error_no;
            break;
        }
    case "edit": {
            $categories = new Categories(Validator::request("cat_id"));
            $categories->cat_name = Validator::request("cat_name");
            $status = $categories->update();
            $code = $categories->error_no;
            break;
        }
    case "delete": {
            $categories = new Categories(Validator::request("cat_id"));
            $status = $categories->delete();
            $code = $categories->error_no;
            break;
        }
}
header("Location: categories.php?status=" . $status . "&code=" . $code);
?>