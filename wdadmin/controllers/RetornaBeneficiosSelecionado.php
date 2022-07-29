<?php

require_once "../class/Beneficios.class.php";

$Beneficios = new Beneficios();
$Beneficios->setId_beneficios($_POST['viIdBeneficios']);

if ($Beneficios->edita_dados()):
    print $Beneficios->getRetorno_dados();
else:
    print 0;
endif;