<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_AdminMasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Settings.php");
require_once(CLASS_PATH . "Class_Validator.php");
require_once(CLASS_PATH . "Class_Messages.php");

$msg = new Messages();
$settings = new Settings();
$task = Validator::request("task");
$settingsID = Validator::request("sid");

if($task == "edit" && $settingsID != "") {
    $settings->select($settingsID);
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
        $('#settingsList').dataTable({
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
        <tr>
            <th>#</th>
            <th>Empresa</th>
            <th>Endereço</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Fax</th>
            <th>Telem&oacute;vel</th>
            <th>Administrador</th>
            <th>Email de administrador</th>
        </tr>
    </thead>
    <tbody>

        <?php
        (bool) $ok = $settings->select('1');
        if($ok) {
            echo "<tr>\n";
            echo "<td><a href=\"settings.php?task=edit&sid=" . $settings->id . "\">" . $settings->id . "</a></td>\n";
            echo "<td>" . $settings->company_name . "</td>\n";
            echo "<td>" . $settings->company_address . "</td>\n";
            echo "<td>" . $settings->company_email . "</td>\n";
            echo "<td>" . $settings->company_phone . "</td>\n";
            echo "<td>" . $settings->company_fax . "</td>\n";
            echo "<td>" . $settings->company_mobile . "</td>\n";
            echo "<td>" . $settings->username . "</td>\n";
            echo "<td>" . $settings->admin_email . "</td>\n";
            echo "<td><a href=\"Controller_Settings.php?task=delete&sid=" . $settings->id . "\">Delete</a></td>\n";
            echo "</tr>\n";
        }
        ?>

    </tbody>
</table>

<fieldset>
    <legend>Settings</legend>
    <form name="formCategories" action="Controller_Settings.php" method="post">
        <input name="task" type="hidden"
               value="<?php echo $task == "" || $task == "delete" ? "add" : $task; ?>" />
        <input name="sid" type="hidden"
               value="<?php echo $task == "edit" ? $settings->id  : ""; ?>" />
        <label>Empresa</label>
        <input name="company_name" class="text" type="text"
               value="<?php echo $task == "edit" ? $settings->company_name : ""; ?>" /><br />
        <label>Endere&ccedil;</label>
        <input name="company_address" class="text" type="text"
               value="<?php echo $task == "edit" ? $settings->company_address : ""; ?>" /><br />
        <label>Email</label>
        <input name="company_email" class="text" type="text"
               value="<?php echo $task == "edit" ? $settings->company_email : ""; ?>" /><br />
        <label>Telefone</label>
        <input name="company_phone" class="text" type="text"
               value="<?php echo $task == "edit" ? $settings->company_phone : ""; ?>" /><br />
        <label>Fax</label>
        <input name="company_fax" class="text" type="text"
               value="<?php echo $task == "edit" ? $settings->company_fax : ""; ?>" /><br />
        <label>Telem&oacute;vel</label>
        <input name="company_mobile" class="text" type="text"
               value="<?php echo $task == "edit" ? $settings->company_mobile : ""; ?>" /><br />
        <label>Username</label>
        <input name="username" class="text" type="text"
               value="<?php echo $task == "edit" ? $settings->username : ""; ?>" /><br />
        <label>Password</label>
        <input name="password" class="text" type="text"
               value="" /><br />
        <label>Email de Administra&ccedil;&atilde;o</label>
        <input name="admin_email" class="text" type="text"
               value="<?php echo $task == "edit" ? $settings->admin_email : ""; ?>" /><br />
        <input class="submit" type="submit" value="submit" />
    </form>
</fieldset>

<?php
$customMain = ob_get_clean();

$master = new AdminMasterPage("[ Opções ]");
$master->setCustomHead($customHead);
$master->setCustomMain($customMain);
$master->setCustomSideBar($customSideBar);
$master->show();
?>
