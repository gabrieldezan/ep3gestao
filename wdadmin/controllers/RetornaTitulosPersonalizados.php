<?php

require_once "../class/TitulosPersonalizados.class.php";

$TitulosPersonalizados = new TitulosPersonalizados();

if ($TitulosPersonalizados->consulta_dados()):
    print $TitulosPersonalizados->getRetorno_dados();
else:
    print 0;
endif;