<?php

require_once "../class/Enderecos.class.php";

$Enderecos = new Enderecos();
$Enderecos->setId_enderecos($_POST['viIdEnderecos']);

if ($Enderecos->edita_dados()):
    print $Enderecos->getRetorno_dados();
else:
    print 0;
endif;