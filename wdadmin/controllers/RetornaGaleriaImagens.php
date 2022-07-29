<?php

require_once "../class/GaleriaImagens.class.php";

$GaleriaImagens = new GaleriaImagens();
$GaleriaImagens->setId_galeria_grupo($_POST['viFiltroIdGaleriaGrupo']);

if ($GaleriaImagens->consulta_dados()):
    print $GaleriaImagens->getRetorno_dados();
else:
    print 0;
endif;