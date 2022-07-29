<?php

require_once "../class/VitrineProdutosCores.class.php";

$VitrineProdutosCores = new VitrineProdutosCores();
$VitrineProdutosCores->setId_vitrine_produto_cores($_POST['viIdProdutosCores']);

if ($VitrineProdutosCores->edita_dados()):
    print $VitrineProdutosCores->getRetorno_dados();
else:
    print 0;
endif;