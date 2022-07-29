<?php

require_once "../class/Servicos.class.php";

$Servicos = new Servicos();

if ($Servicos->consulta_dados()):
    print $Servicos->getRetorno_dados();
else:
    print 0;
endif;