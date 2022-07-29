<?php

require_once "../class/Acessos.class.php";

$Acessos = new Acessos();
$Acessos->setId_acessos($_POST['inputIdAcessos']);
$Acessos->setFuncao($_POST['inputFuncao']);
$Acessos->setStatus($_POST['inputStatus']);

if ($Acessos->salva_dados()):
    print $Acessos->getRetorno_dados();
else:
    print 0;
endif;