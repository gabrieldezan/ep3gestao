<?php

require_once "../class/UsuarioCliente.class.php";

$UsuarioCliente = new UsuarioCliente();
$UsuarioCliente->setId_usuario_cliente($_POST['viIdUsuarioCliente']);

if ($UsuarioCliente->edita_dados()):
    print $UsuarioCliente->getRetorno_dados();
else:
    print 0;
endif;