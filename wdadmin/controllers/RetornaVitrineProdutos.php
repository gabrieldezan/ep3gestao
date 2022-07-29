<?php

require_once "../class/VitrineProdutos.class.php";

$VitrineProdutos = new VitrineProdutos();
$VitrineProdutos->setId_vitrine_grupo($_POST['viFiltroIdGrupoVitrine']);
$VitrineProdutos->setId_vitrine_subgrupo($_POST['viFiltroIdSubgrupoVitrine']);

if ($VitrineProdutos->consulta_dados()):
    print $VitrineProdutos->getRetorno_dados();
else:
    print 0;
endif;