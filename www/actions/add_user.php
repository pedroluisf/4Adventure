<?php
// TODO: testar após fazer os settings na admin
require_once '../includes/class/Config.php';
require_once CLASS_PATH . 'Class_Validator.php';
require_once CLASS_PATH . 'Class_Users.php';
require_once CLASS_PATH . 'Class_Mail.php';
require_once CLASS_PATH . 'Class_Settings.php';
/**
* 
* @version
* @author pedro
*/
if(Validator::request('postback') == 'true') {
    $name = Validator::request('name');
    $company = Validator::request('company');
    $email = Validator::request('email');
    $username = Validator::request('username');
    $password = Validator::request('password');
    $phone = Validator::request('phone');
    $fax = Validator::request('fax');
    $country_id = Validator::request('country');
    $newsletter = Validator::request('newsletter') == 'on' ? 'Y' : 'N';
    $preferred_lang = Validator::request("preferred_lang");
    $user = new Users();

    $user->name = $name;
    $user->company = $company;
    $user->email = $email;
    $user->username = $username;
    $user->password = md5($password);
    $user->phone = $phone;
    $user->fax = $fax;
    $user->country_id = $country_id;
    $user->newsletter = $newsletter;
    $user->preferred_lang = $preferred_lang;
    $user->role = 'R';

    $mailer = new Mail();
    $settings = new Settings();
    $settings->select(1);

    if($user->insert()) {
        $adminMsg = "Novo registo no website. O registo foi concluído com sucesso os dados são: \n" .
                   'Username: ' . $user->username . "\n" .
                   'Empresa: ' . $user->company . "\n" .
                   'Nome: ' . $user->name . "\n" .
                   'Email: ' . $user->email . "\n" .
                   'Telefone: ' . $user->phone . "\n" .
                   'Fax: ' . $user->fax . "\n";
        $userMsg = "Bem-vindo ao nosso website. O registo foi concluído com sucesso e os seus dados são: \n" .
                   'Username: ' . $user->username . "\n" .
                   'Empresa: ' . $user->company . "\n" .
                   'Nome: ' . $user->name . "\n" .
                   'Email: ' . $user->email . "\n" .
                   'Telefone: ' . $user->phone . "\n" .
                   'Fax: ' . $user->fax . "\n";
        // notificar o administrador por email
        $mailer->send('Administrator', $settings->admin_email, $adminMsg);
        // confirmar registo no site enviando mail para o cliente
        $mailer->send('Administrator', $user->email, $userMsg);
        header('Location: ../register.php?code=0');
    } else {
        header('Location: ../register.php?code=' . $user->error_no);
    }

}
?>
