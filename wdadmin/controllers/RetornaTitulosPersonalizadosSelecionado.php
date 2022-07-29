<?php

require_once "../class/TitulosPersonalizados.class.php";

$TitulosPersonalizados = new TitulosPersonalizados();
$TitulosPersonalizados->setId_titulos_personalizados($_POST['viIdTitulosPersonalizados']);

if ($TitulosPersonalizados->edita_dados()):
    print $TitulosPersonalizados->getRetorno_dados();
else:
    print 0;
endif;