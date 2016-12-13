<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_AdminMasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Items.php");
require_once(CLASS_PATH . "Class_Validator.php");
require_once(CLASS_PATH . "Class_Messages.php");
require_once(CLASS_PATH . "Class_Utilities.php");

$msg = new Messages();
$item = new Items();
$task = Validator::request("task");
$itemID = Validator::request("itmid");

if($task == "edit" && $itemID != "") {
    $item->select($itemID);
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
        <tr><th>Refer&ecirc;ncia</th><th>Marca</th><th>Categoria</th><th>Pre&ccedil;o</th><th>Apagar</th></tr>
    </thead>
    <tbody>

        <?php
        $db = new Db();
        $sql = "SELECT items.*, brands.name, cat_name " .
               "FROM items INNER JOIN brands ON brand_id = brdid " .
               "INNER JOIN categories ON items.cat_id = categories.cat_id";
        $r = $db->dbQuery($sql);
        while($row = $db->dbGetRow($r)) {
            echo "<tr>";
            echo "<td><a href=\"items.php?task=edit&itmid=" . $row->itmid . "\">" . $row->ref . "</a></td>";
            echo "<td>" . $row->name . "</td>";
            echo "<td>" . $row->cat_name . "</td>";
            echo "<td>" . $row->price . "</td>";
            echo "<td><a href=\"Controller_Items.php?task=delete&itmid=" . $row->itmid . "\">Delete</a></td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>

<fieldset>
    <legend>Items</legend>
    <form name="formItems" action="Controller_Items.php" method="post">
        <input name="task" type="hidden"
               value="<?php echo $task == "" ? "add" : $task; ?>" />
        <input name="itmid" type="hidden"
               value="<?php echo $task == "edit" ? $item->itmid : ""; ?>" />
        <label>Refer&ecirc;ncia</label>
        <input name="ref" class="text" type="text"
               value="<?php echo $task == "edit" ? $item->ref : ""; ?>" /><br />
        <label>Marca</label>
        <?php Utilities::htmlCombobox("brand_id",
            "brand_id",
            "SELECT brdid, name FROM brands ORDER BY name",
            $task == "edit" ? $item->brand_id : "") ?><br />
        <label>Categoria</label>
        <?php Utilities::htmlCombobox("cat_id",
            "cat_id",
            "SELECT cat_id, cat_name FROM categories ORDER BY cat_name",
            $task == "edit" ? $item->cat_id : "") ?><br />
            <label>Pre&ccedil;o</label>
        <input name="price" class="text" type="text"
               value="<?php echo $task == "edit" ? $item->price : ""; ?>" /><br />
        <input class="submit" type="submit" value="submit" />
    </form>
</fieldset>

<?php
$customMain = ob_get_clean();

$master = new AdminMasterPage("[ Items ]");
$master->setCustomHead($customHead);
$master->setCustomMain($customMain);
$master->setCustomSideBar($customSideBar);
$master->show();
?>