<?php

require_once "../class/VitrineProdutosCores.class.php";

$VitrineProdutosCores = new VitrineProdutosCores();

$VitrineProdutosCores->setId_vitrine_produto($_POST['viIdProduto']);

if ($VitrineProdutosCores->consulta_dados()):
    print $VitrineProdutosCores->getRetorno_dados();
else:
    print 0;
endif;