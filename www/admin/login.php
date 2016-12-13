<?php
require_once('../../includes/class/Config.php');
require_once(CLASS_PATH . 'Class_Authenticate.php');

/**
*
* @version
* @author pedro
*/
if(
    Validator::post('postback') == true &&
    Validator::isFilled('username') &&
    Validator::isFilled('password')
    ) {

    session_start();
    $username = Validator::post('username');
    $password = Validator::post('password');
    $auth = new Authenticate();
    if((bool)$auth->login($username, $password) === true) {
        header('Location:index.php');
    }
}
?>

<form name="loginForm" action="login.php" method="post">
    <input name="postback" type="hidden" value="true" />
    <label for="username">Username</label>
    <input name="username" type="text" />
    <label for="password">Password</label>
    <input name="password" type="password" />
    <br/>
    <input type="submit" value="login" />
</form>

