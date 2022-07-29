<?php

require_once "../class/UsuarioCliente.class.php";

$UsuarioCliente = new UsuarioCliente();

if ($UsuarioCliente->consulta_dados()):
    print $UsuarioCliente->getRetorno_dados();
else:
    print 0;
endif;