<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_AdminMasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Items_details.php");
require_once(CLASS_PATH . "Class_Validator.php");
require_once(CLASS_PATH . "Class_Messages.php");
require_once(CLASS_PATH . "Class_Utilities.php");

$msg = new Messages();
$detail = new Items_details();
$task = Validator::request("task");
$detailID = Validator::request("det_id");

if($task == "edit" && $detailID != "") {
    $detail->select($detailID);
}

ob_clean();
ob_start();
?>

<style type="text/css" title="currentStyle">
    @import "./css/demo_page.css";
    @import "./css/demo_table.css";
</style>
<script type="text/javascript" language="javascript" src="./js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="./js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#itemList').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true,
            "sPaginationType": "full_numbers",
            "oLanguage": {
                "sLengthMenu": "Mostrar _MENU_ registos",
                "sZeroRecords": "Não foram encontrados registos",
                "sInfo": "A visualizar _START_ até _END_ de _TOTAL_ registos",
                "sInfoEmpty": "Nenhum registo",
                "sInfoFiltered": "(filtrados de _MAX_ registos)",
                "sProcessing":   "A processar...",
                "sSearch":       "Procurar:",
                "oPaginate": {
                    "sFirst":    "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext":     "Seguinte",
                    "sLast":     "Último"
                }
            }
        })
    });
</script>

<?php
$customHead = ob_get_clean();

ob_start();
// messages to user
if(Validator::exists("status") && Validator::exists("code")) {
    (bool) $status = Validator::request("status");
    (int) $code = Validator::request("code");
    ?>
<p class="<?php echo $status ? "gt-success" : "gt-error"; ?>"><?php echo Messages::getMessage($code) ?></p>
    <?php
}
?>

<table id="itemList" class="display">
    <thead>
        <tr><th>Refer&ecirc;ncia</th><th>Descrição</th><th>L&iacute;ngua</th><th>Apagar</th></tr>
    </thead>
    <tbody>

        <?php
        $db = new Db();
        $sql = "SELECT t1.det_id, t0.ref, t1.short_description, t2.language " .
               "FROM `items_details` t1 INNER JOIN `items` t0 ON t0.itmid = t1.item_id " .
               "INNER JOIN `languages` t2 ON t1.lang = t2.langid";
        $r = $db->dbQuery($sql);
        while($row = $db->dbGetRow($r)) {
            echo "<tr>";
            echo "<td><a href=\"item_details.php?task=edit&det_id=" . $row->det_id . "\">" . $row->ref . "</a></td>";
            echo "<td>" . $row->short_description . "</td>";
            echo "<td>" . $row->language . "</td>";
            echo "<td><a href=\"Controller_Item_Details.php?task=delete&det_id=" . $row->det_id . "\">Delete</a></td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>

<fieldset>
    <legend>Items Details</legend>
    <form name="formItemsDetails" action="Controller_Item_Details.php" method="post">
        <input name="task" type="hidden"
               value="<?php echo $task == "" ? "add" : $task; ?>" />
        <input name="det_id" type="hidden"
               value="<?php echo $task == "edit" ? $detail->det_id : ""; ?>" />
        <label>Ref</label>
        <?php Utilities::htmlCombobox("item_id",
            "item_id",
            "SELECT itmid, ref FROM items ORDER BY ref",
            $task == "edit" ? $detail->item_id : null) ?><br />
        <label>Descrição</label>
        <input name="short_desc" class="text" type="text"
               value="<?php echo $task == "edit" ? $detail->short_description : ""; ?>" /><br />
        <label>Detalhe</label>
        <input name="long_desc" class="text" type="text"
               value="<?php echo $task == "edit" ? $detail->long_description : ""; ?>" /><br />
        <label>Linguagem</label>
        <?php Utilities::htmlCombobox("lang",
            "lang",
            "SELECT langid, language FROM languages ORDER BY language",
            $task == "edit" ? $detail->lang : null) ?><br />
        <input class="submit" type="submit" value="submit" />
    </form>
</fieldset>

<?php
$customMain = ob_get_clean();

$master = new AdminMasterPage("[ Item Details ]");
$master->setCustomHead($customHead);
$master->setCustomMain($customMain);
$master->setCustomSideBar($customSideBar);
$master->show();
?>
