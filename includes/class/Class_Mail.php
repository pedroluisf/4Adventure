<?php
require_once 'Config.php';
require_once 'class.phpmailer.php';

/**
* 
* @version 1
* @author pedro
*/

class Mail {

    public function  __construct() {

    }

    public function send($fromname, $fromemail, $name, $email, $subject, $msg) {
        error_reporting(E_STRICT);
        date_default_timezone_set('Europe/Lisbon');

        $mail             = new PHPMailer();
        $mail->From       = $fromemail;
        $mail->FromName   = $fromname;
        $mail->Subject    = $subject;
        $mail->Body       = $msg;
        $mail->AddAddress($email, $name);

        return $mail->Send();
    }
}
?>
