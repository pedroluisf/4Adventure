<?php
require_once("includes/class/Config.php");
require_once(CLASS_PATH . "Class_InnerMasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Utilities.php");
require_once(CLASS_PATH . "Class_Pages.php");

/**
 *
 * @version
 * @author pedro
 */

ob_clean();
ob_start();
?>
<form name="registerForm" action="actions/add_user.php" method="post">
    <input name="postback" value="true" type="hidden" />
    <div id="submitform">
        <div id="submitformtop">
            <div class="submitforml">* Campos obrigat&oacute;rios</div>
            <div class="submitformr"></div>
        </div>

        <div class="submitformtop">
            <div class="submitforml">Nome *</div>
            <div class="submitformr">
                <input name="name" type="text" class="stext" />
            </div>
        </div>

        <div class="submitformtop">
            <div class="submitforml">Empresa *</div>
            <div class="submitformr">
                <input name="company" type="text" class="stext" />
            </div>
        </div>

        <div class="submitformtop">
            <div class="submitforml">Email *</div>
            <div class="submitformr">
                <input name="email" type="text" class="stext" />
            </div>
        </div>

        <div class="submitformtop">
            <div class="submitforml">Username *</div>
            <div class="submitformr">
                <input name="username" type="text" class="stext" />
            </div>
        </div>

        <div class="submitformtop">
            <div class="submitforml">Password *</div>
            <div class="submitformr">
                <input name="password" type="password" class="stext" />
            </div>
        </div>

        <div class="submitformtop">
            <div class="submitforml">Telefone *</div>
            <div class="submitformr">
                <input name="phone" type="text" class="stext" />
            </div>
        </div>

        <div class="submitformtop">
            <div class="submitforml">Fax</div>
            <div class="submitformr">
                <input name="fax" type="text" class="stext" />
            </div>
        </div>

        <div class="submitformtop">
            <div class="submitforml">Pa&iacute;s</div>
            <div class="submitformr">
                <?php Utilities::htmlCombobox("country", "country", "SELECT cntid, country_name FROM countries"); ?>
            </div>
        </div>

        <div class="submitformtop">
            <div class="submitforml">Newsletter</div>
            <div class="submitformr">
                <input name="newsletter" type="checkbox"/>
            </div>
        </div>

       <div class="submitformtop">
            <div class="submitforml">Linguagem</div>
            <div class="submitformr">
                <?php Utilities::htmlCombobox("preferred_lang", "preferred_lang", "SELECT langid, language FROM languages") ?>
            </div>
        </div>


        <div class="submitformbottom">
            <div class="submitformr2">
                <input name="submit" type="submit" value="submit"/>
            </div>
        </div>

    </div>
</form>


<?php
$customContents = ob_get_clean();
$page = new InnerMasterPage("Registo");
$page->setCustomBottomLeftSection($customContents);
$page->show();

?>

