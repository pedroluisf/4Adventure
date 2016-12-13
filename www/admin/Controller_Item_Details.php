<?php
include("../includes/class/Config.php");
include(CLASS_PATH . "Class_Items_details.php");
include(CLASS_PATH . "Class_Validator.php");


/**
 * Controls actions for items form.
 * @version
 * @author pedro
 */

$task = Validator::request("task");
(bool) $status = false;
(int) $code = 0;
switch($task) {
    case "add" : {
            $detail = new Items_details();
            $detail->item_id = Validator::request("item_id");
            $detail->short_description = Validator::request("short_desc");
            $detail->long_description = Validator::request("long_desc");
            $detail->lang = Validator::request("lang");
            $status = $detail->insert();
            $code = $detail->error_no;
            break;
        }
    case "edit" : {
            $detail = new Items_details(Validator::request("det_id"));
            $detail->item_id = Validator::request("item_id");
            $detail->short_description = Validator::request("short_desc");
            $detail->long_description = Validator::request("long_desc");
            $detail->lang = Validator::request("lang");
            $status = $detail->update();
            $code = $detail->error_no;
            break;
        }
    case "delete" : {
            $detail = new Items_details(Validator::request("det_id"));
            $status = $detail->delete();
            $code = $detail->error_no;
            break;
        }
}

header("Location: item_details.php?status=" . $status . "&code=" . $code);

?>