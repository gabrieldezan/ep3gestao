<?php

require_once "../class/Cases.class.php";

$Cases = new Cases();
$Cases->setId_clientes($_POST['viFiltroIdClientes']);

if ($Cases->consulta_dados()):
    print $Cases->getRetorno_dados();
else:
    print 0;
endif;