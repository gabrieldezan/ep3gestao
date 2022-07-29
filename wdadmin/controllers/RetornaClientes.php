<?php

require_once "../class/Clientes.class.php";

$Clientes = new Clientes();

if ($Clientes->consulta_dados()):
    print $Clientes->getRetorno_dados();
else:
    print 0;
endif;