<?php

require_once "../class/Informacoes.class.php";

$Informacoes = new Informacoes();
$Informacoes->setId_informacoes($_POST['viIdInformacoes']);

if ($Informacoes->edita_dados()):
    print $Informacoes->getRetorno_dados();
else:
    print 0;
endif;