<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_AdminMasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Categories.php");
require_once(CLASS_PATH . "Class_Validator.php");
require_once(CLASS_PATH . "Class_Messages.php");

$msg = new Messages();
$category = new Categories();
$task = Validator::request("task");
$categoryID = Validator::request("cat_id");

if($task == "edit" && $categoryID != "") {
    $category->select($categoryID);
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
        $('#categoryList').dataTable({
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

<table id="categoryList" class="display">
    <thead>
        <tr><th>#</th><th>Nome</th><th>Apagar</th></tr>
    </thead>
    <tbody>

        <?php
        $db = new Db();
        $sql = "SELECT * FROM categories";
        $r = $db->dbQuery($sql);
        while($row = $db->dbGetRow($r)) {
            echo "<tr>\n";
            echo "<td><a href=\"categories.php?task=edit&cat_id=" . $row->cat_id . "\">" . $row->cat_id . "</a></td>\n";
            echo "<td>" . $row->cat_name . "</td>\n";
            echo "<td><a href=\"Controller_Categories.php?task=delete&cat_id=" . $row->cat_id . "\">Delete</a></td>\n";
            echo "</tr>\n";
        }
        ?>

    </tbody>
</table>

<fieldset>
    <legend>Categories</legend>
    <form name="formCategories" action="Controller_Categories.php" method="post">
        <input name="task" type="hidden"
               value="<?php echo $task == "" || $task == "delete" ? "add" : $task; ?>" />
        <input name="cat_id" type="hidden"
               value="<?php echo $task == "edit" ? $category->cat_id : ""; ?>" />
        <label>Nome</label>
        <input name="cat_name" class="text" type="text"
               value="<?php echo $task == "edit" ? $category->cat_name : ""; ?>" /><br />
        <input class="submit" type="submit" value="submit" />
    </form>
</fieldset>

<?php
$customMain = ob_get_clean();

$master = new AdminMasterPage("[ Categories ]");
$master->setCustomHead($customHead);
$master->setCustomMain($customMain);
$master->setCustomSideBar($customSideBar);
$master->show();
?>
