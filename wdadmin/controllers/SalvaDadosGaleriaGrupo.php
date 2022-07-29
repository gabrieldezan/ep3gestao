<?php

require_once "../class/GaleriaGrupos.class.php";

$GaleriaGrupos = new GaleriaGrupos();
$GaleriaGrupos->setId_galeria_grupo($_POST['inputIdGaleriaGrupos']);
$GaleriaGrupos->setDescricao($_POST['inputDescricao']);
$GaleriaGrupos->setStatus($_POST['inputStatus']);

if ($GaleriaGrupos->salva_dados()):
    print $GaleriaGrupos->getRetorno_dados();
else:
    print 0;
endif;