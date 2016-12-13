<?php
require_once("../includes/class/Config.php");
require_once(CLASS_PATH . "Class_MasterPage.php");
require_once(CLASS_PATH . "Class_Db.php");
require_once(CLASS_PATH . "Class_Validator.php");
require_once(CLASS_PATH . "Class_Utilities.php");
require_once CLASS_PATH . 'Class_Mail.php';
require_once CLASS_PATH . 'Class_Settings.php';

/**
 *
 * @version
 * @author pedro
 */
if(Validator::request('postback') == 'true') {
    $nome = Validator::request('nome');
    $email = Validator::request('email');
    $assunto = Validator::request('assunto');
    $mensagem = Validator::request('mensagem');

    $mailer = new Mail();
    $settings = new Settings();
    $settings->select(1);

    if ($assunto != '' && $mensagem != ''){
        $sended = $mailer->send($nome, $email, $settings->company_name, $settings->admin_email, $assunto, $mensagem);
    }

}

ob_clean();
ob_start();

    if(isset($sended)){
        if($sended){
            echo '<h2>Mensagem enviada</h2>';
        } else {
            echo '<h2>Erro a enviar mensagem </h2>';
        }
    }

?>
<h3>Entre em contacto conosco e venha nos conhecer melhor.</h3>
<br/>
<div id="formwrapperborder">
    <form name="contactForm" action="#" method="post">
        <input name="postback" value="true" type="hidden" />
        <div id="submitform">
            <div class="submitformtop">
                <div class="submitforml">Nome</div>
                <div class="submitformr">
                    <input name="nome" type="text" class="stext" />
                </div>
            </div>

            <div class="submitformtop">
                <div class="submitforml">Email</div>
                <div class="submitformr">
                    <input name="email" type="text" class="stext" />
                </div>
            </div>

            <div class="submitformtop">
                <div class="submitforml">Assunto</div>
                <div class="submitformr">
                    <input name="assunto" type="text" class="stext" />
                </div>
            </div>

            <div class="submitformtoplarge">
                <div class="submitforml">Mensagem</div>
                <div class="submitformc">
                    <textarea name="mensagem" cols="40" rows="5"></textarea>
                </div>
            </div>
            <div class="submitformbottom">
                <input type="image" src="images/okbtn.png" onmouseover="this.src='images/okbtn_hover.png'" onmouseout="this.src='images/okbtn.png'" alt="submit button" />
            </div>
        </div>
    </form>
</div>

<?php
$customContents = ob_get_clean();
$page = new MasterPage(0, "Contactos", 0);
$page->setcustomMainSection($customContents);
$page->setcustomThumbSection('<img src="images/contactos.png" width="290px" />');
$page->show();
?>