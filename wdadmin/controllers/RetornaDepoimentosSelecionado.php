<?php

require_once "../class/Depoimentos.class.php";

$Depoimentos = new Depoimentos();
$Depoimentos->setId_depoimentos($_POST['viIdDepoimentos']);

if ($Depoimentos->edita_dados()):
    print $Depoimentos->getRetorno_dados();
else:
    print 0;
endif;