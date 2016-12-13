<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_AdminMasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Pages.php");
require_once(CLASS_PATH . "Class_Validator.php");
require_once(CLASS_PATH . "Class_Messages.php");
require_once(CLASS_PATH . "Class_Utilities.php");

$msg = new Messages();
$page = new Pages();
$task = Validator::request("task");
$pageID = Validator::request("pagid");

if($task == "edit" && $pageID != "") {
    $page->select($pageID);
}

ob_clean();
ob_start();
?>

<style type="text/css" title="currentStyle">
    @import "./css/demo_page.css";
    @import "./css/demo_table.css";
</style>
<script src="http://cdn.jquerytools.org/1.2.5/form/jquery.tools.min.js"></script>
<script>
    $(document).ready(function() {
        $(":date").dateinput();
    }); 
</script>
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#pageList').dataTable({
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
<!-- TinyMCE -->
<script type="text/javascript" src="js/sb/sb.js"></script>
<script type="text/javascript" src="js/tiny_mce/tiny_mce_gzip.js"></script>
<script type="text/javascript">
tinyMCE_GZ.init({
    file_browser_callback : "openSwampyBrowser",
	plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",
	theme : 'advanced',
	languages : 'en',
	disk_cache : true,
	debug : false
});
</script>

<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
        file_browser_callback : "openSwampyBrowser",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true

	});
</script> -->
<!-- /TinyMCE -->
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

<table id="pageList" class="display">
    <thead>
        <tr><th>ID</th><th>Titulo</th><th>Data</th><th>Categoria</th><th>Apagar</th></tr>
    </thead>
    <tbody>

        <?php
        $db = new Db();
        $sql = "SELECT p.pagid, p.url, p.title, p.datepost, c.category as catdesc FROM pages p left join categories c on p.catid=c.catid ";
        $r = $db->dbQuery($sql);
        while($row = $db->dbGetRow($r)) {
            echo "<tr>";
            echo "<td><a href=\"pages.php?task=edit&pagid=" . $row->pagid . "\">" . $row->pagid . "</a></td>";
            echo "<td><a href=\"pages.php?task=edit&pagid=" . $row->pagid . "\">" . $row->title . "</a></td>";
            echo "<td><a href=\"pages.php?task=edit&pagid=" . $row->pagid . "\">" . $row->datepost . "</a></td>";
            echo "<td>" . $row->catdesc . "</td>";
            echo "<td><a href=\"Controller_Pages.php?task=delete&pagid=" . $row->pagid . "\">Delete</a></td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>

<fieldset>
    <legend>Pages</legend>
    <form name="formpages" action="Controller_Pages.php" method="post">
        <input name="task" type="hidden"
               value="<?php echo $task == "" ? "add" : $task; ?>" />
        <input name="pagid" type="hidden"
               value="<?php echo $task == "edit" ? $page->pagid : ""; ?>" />
        <input name="url" type="hidden"
               value="<?php echo $task == "edit" ? $page->url : ""; ?>" /><br />
        <label>Imagem: </label>
        <input name="thumb" class="text" type="text"
               value="<?php echo $task == "edit" ? $page->thumb : ""; ?>" /><br />
        <label>T&iacute;tulo: </label>
        <input name="title" class="text" type="text" 
               value="<?php echo $task == "edit" ? $page->title : ""; ?>" /><br />
        <label>Data Evento: </label>
        <input type="date" name="datepost"
               value="<?php echo $task == "edit" ? date('Y-m-d', strtotime($page->datepost)) : ""; ?>" /><br />
        <label>Hora Evento: </label>
        <input type="time" name="timepost"
               value="<?php echo $task == "edit" ? date('G:i', strtotime($page->datepost)) : ""; ?>" /><br />
        <label>Categoria: </label>
        <?php Utilities::htmlCombobox("catid",
            "catid",
            "SELECT catid, category FROM categories ORDER BY category",
            $task == "edit" ? $page->catid : null) ?><br />
        <label>Linguagem: </label>
        <?php Utilities::htmlCombobox("lang",
            "lang",
            "SELECT langid, language FROM languages ORDER BY language",
            $task == "edit" ? $page->lang : null) ?><br />
            <br />
        <textarea name="contents" id="contents" cols="25" rows="5">
               <?php echo $task == "edit" ? $page->contents : ""; ?>
        </textarea><br />
        <input class="submit" type="submit" value="submit"/>
    </form>
</fieldset>

<?php
$customMain = ob_get_clean();

$master = new AdminMasterPage("4Adventure - Gest&atilde;o de Conteudos");
$master->setCustomHead($customHead);
$master->setcustomMainSection($customMain);
$master->show();
?>