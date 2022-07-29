<?php

require_once "../class/Informacoes.class.php";

$Informacoes = new Informacoes();
$Informacoes->setId_conteudo_personalizado($_POST['vsIdConteudoPersonalizado']);

if ($Informacoes->consulta_dados()):
    print $Informacoes->getRetorno_dados();
else:
    print 0;
endif;