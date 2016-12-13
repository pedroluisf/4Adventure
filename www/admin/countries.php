<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_AdminMasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Countries.php");
require_once(CLASS_PATH . "Class_Validator.php");
require_once(CLASS_PATH . "Class_Messages.php");

$msg = new Messages();
$country = new Countries();
$task = Validator::request("task");
$countryID = Validator::request("cntid");

if($task == "edit" && $countryID != "") {
    $country->select($countryID);
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
        $('#countryList').dataTable({
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

<table id="countryList" class="display">
    <thead>
        <tr><th>#</th><th>Nome</th><th>C&oacute;digo</th><th>Apagar</th></tr>
    </thead>
    <tbody>

        <?php
        $db = new Db();
        $sql = "SELECT * FROM countries";
        $r = $db->dbQuery($sql);
        while($row = $db->dbGetRow($r)) {
            echo "<tr>\n";
            echo "<td><a href=\"countries.php?task=edit&cntid=" . $row->cntid . "\">" . $row->cntid . "</a></td>\n";
            echo "<td>" . $row->country_name . "</td>\n";
            echo "<td>" . $row->country_code . "</td>\n";
            echo "<td><a href=\"Controller_Countries.php?task=delete&cntid=" . $row->cntid . "\">Delete</a></td>\n";
            echo "</tr>\n";
        }
        ?>

    </tbody>
</table>

<fieldset>
    <legend>Countries</legend>
    <form name="formCountries" action="Controller_Countries.php" method="post">
        <input name="task" type="hidden"
               value="<?php echo $task == "" ? "add" : $task; ?>" />
        <input name="cntid" type="hidden"
               value="<?php echo $task == "edit" ? $country->cntid : ""; ?>" />
        <label>Nome</label>
        <input name="country_name" class="text" type="text"
               value="<?php echo $task == "edit" ? $country->country_name : ""; ?>" /><br />
        <label>C&oacute;digo</label>
        <input name="country_code" class="text" type="text"
               value="<?php echo $task == "edit" ? $country->country_code : ""; ?>" /><br />

        <input class="submit" type="submit" value="submit" />
    </form>
</fieldset>

<?php
$customMain = ob_get_clean();

$master = new AdminMasterPage("[ Countries ]");
$master->setCustomHead($customHead);
$master->setCustomMain($customMain);
$master->setCustomSideBar($customSideBar);
$master->show();
?>
