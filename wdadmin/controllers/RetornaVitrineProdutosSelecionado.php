<?php

require_once "../class/VitrineProdutos.class.php";

$VitrineProdutos = new VitrineProdutos();
$VitrineProdutos->setId_vitrine_produto($_POST['viIdVitrineProdutos']);

if ($VitrineProdutos->edita_dados()):
    print $VitrineProdutos->getRetorno_dados();
else:
    print 0;
endif;