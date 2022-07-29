<?php

require_once "../class/Servicos.class.php";

$Servicos = new Servicos();
$Servicos->setId_servicos($_POST['viIdServicos']);

if ($Servicos->edita_dados()):
    print $Servicos->getRetorno_dados();
else:
    print 0;
endif;