<?php

require_once "../class/GaleriaImagens.class.php";

$GaleriaImagens = new GaleriaImagens();
$GaleriaImagens->setId_galeria_imagem($_POST['viIdGaleriaImagens']);

if ($GaleriaImagens->edita_dados()):
    print $GaleriaImagens->getRetorno_dados();
else:
    print 0;
endif;