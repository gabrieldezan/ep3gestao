<?php

require_once "../class/Acessos.class.php";

$Acessos = new Acessos();
$Acessos->setId_acessos($_POST['viIdAcessos']);

if ($Acessos->edita_dados()):
    print $Acessos->getRetorno_dados();
else:
    print 0;
endif;