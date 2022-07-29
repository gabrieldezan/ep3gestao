<?php

require_once "../class/Login.class.php";

$Login = new Login();
$Login->setLogin($_POST['login']);
$Login->setSenha(md5($_POST['senha']));

if ($Login->login()) {
    print 1;
} else {
    print 0;
}