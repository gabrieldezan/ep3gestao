<?php

require_once "../class/Clientes.class.php";

$Clientes = new Clientes();
$Clientes->setId_clientes($_POST['viIdClientes']);

if ($Clientes->edita_dados()):
    print $Clientes->getRetorno_dados();
else:
    print 0;
endif;