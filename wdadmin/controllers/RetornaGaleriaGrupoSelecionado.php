<?php

require_once "../class/GaleriaGrupos.class.php";

$GaleriaGrupos = new GaleriaGrupos();
$GaleriaGrupos->setId_galeria_grupo($_POST['viIdGaleriaGrupos']);

if ($GaleriaGrupos->edita_dados()):
    print $GaleriaGrupos->getRetorno_dados();
else:
    print 0;
endif;