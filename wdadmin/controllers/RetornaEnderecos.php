<?php

require_once "../class/Enderecos.class.php";

$Enderecos = new Enderecos();

if ($Enderecos->consulta_dados()):
    print $Enderecos->getRetorno_dados();
else:
    print 0;
endif;