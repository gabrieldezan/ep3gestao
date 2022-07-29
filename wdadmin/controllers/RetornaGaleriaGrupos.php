<?php

require_once "../class/GaleriaGrupos.class.php";

$GaleriaGrupos = new GaleriaGrupos();

if ($GaleriaGrupos->consulta_dados()):
    print $GaleriaGrupos->getRetorno_dados();
else:
    print 0;
endif;