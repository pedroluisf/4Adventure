<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_AdminMasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Brands.php");
require_once(CLASS_PATH . "Class_Validator.php");
require_once(CLASS_PATH . "Class_Messages.php");

$msg = new Messages();
$brand = new brands();
$task = Validator::request("task");
$brandID = Validator::request("brdid");

if($task == "edit" && $brandID != "") {
    $brand->select($brandID);
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
        $('#brandList').dataTable({
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

<table id="brandList" class="display">
    <thead>
        <tr><th>#</th><th>Nome</th><th>Url</th><th>Logo</th><th>Apagar</th></tr>
    </thead>
    <tbody>

        <?php
        $db = new Db();
        $sql = "SELECT * FROM brands";
        $r = $db->dbQuery($sql);
        while($row = $db->dbGetRow($r)) {
            $logo = ($row->logo == "") ? "" : "../uploads/" . $row->logo;
            echo "<tr>\n";
            echo "<td><a href=\"brands.php?task=edit&brdid=" . $row->brdid . "\">" . $row->brdid . "</a></td>\n";
            echo "<td>" . $row->name . "</td>\n";
            echo "<td>" . $row->url . "</td>\n";
            echo "<td><img src=\"../Resize.php?src=uploads/".$logo."&x=50&y=50\" /></td>\n";
            echo "<td><a href=\"Controller_Brands.php?task=delete&brdid=" . $row->brdid . "\">Delete</a></td>\n";
            echo "</tr>\n";
        }
        ?>

    </tbody>
</table>

<fieldset>
    <legend>Brands</legend>
    <form name="formbrands" action="Controller_Brands.php" method="post" enctype="multipart/form-data">
        <input name="task" type="hidden"
               value="<?php echo $task == "" || $task == "delete" ? "add" : $task; ?>" />
        <input name="brdid" type="hidden"
               value="<?php echo $task == "edit" ? $brand->brdid : ""; ?>" />
        <label>Nome</label>
        <input name="name" class="text" type="text"
               value="<?php echo $task == "edit" ? $brand->name : ""; ?>" /><br />
        <label>Url</label>
        <input name="url" class="text" type="text"
               value="<?php echo $task == "edit" ? $brand->url : ""; ?>" /><br />
        <label>Logo</label>
        <input name="logo" class="text" type="file" /><br/>
        <input name="dbLogo" class="text" type="hidden"
               value="<?php echo $task == "edit" ? $brand->logo : ""; ?>" />
        <input class="submit" type="submit" value="submit" />
    </form>
</fieldset>

<?php
$customMain = ob_get_clean();

$master = new AdminMasterPage("[ Brands ]");
$master->setCustomHead($customHead);
$master->setCustomMain($customMain);
$master->setCustomSideBar($customSideBar);
$master->show();
?>
