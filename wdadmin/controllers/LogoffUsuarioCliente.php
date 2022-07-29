<?php

require_once "../class/UsuarioCliente.class.php";

$UsuarioCliente = new UsuarioCliente();

if ($UsuarioCliente->logoff()):
    print 1;
else:
    print 0;
endif;