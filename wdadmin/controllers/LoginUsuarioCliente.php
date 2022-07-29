<?php

require_once "../class/UsuarioCliente.class.php";

$UsuarioCliente = new UsuarioCliente();
$UsuarioCliente->setEmail($_POST['email']);
$UsuarioCliente->setSenha(md5($_POST['senha']));

if ($UsuarioCliente->login()) {
    print 1;
} else {
    print 0;
}