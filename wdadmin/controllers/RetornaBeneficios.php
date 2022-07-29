<?php

require_once "../class/Beneficios.class.php";

$Beneficios = new Beneficios();
$Beneficios->setId_planos($_POST["viIdPlanos"]);

if ($Beneficios->consulta_dados()):
    print $Beneficios->getRetorno_dados();
else:
    print 0;
endif;