<?php

require_once "../class/Beneficios.class.php";

$Beneficios = new Beneficios();

$Beneficios->setId_beneficios($_POST['inputIdBeneficios']);
$Beneficios->setTitulo($_POST['inputTituloBeneficios']);
$Beneficios->setStatus($_POST['inputStatusBeneficios']);

$Beneficios->setId_planos($_POST['hiddenIdPlanos']);

if ($Beneficios->salva_dados()) {
    print $Beneficios->getRetorno_dados();
} else {
    print 0;
}