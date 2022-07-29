<?php

require_once "../class/TamanhoImagens.class.php";

$TamanhoImagens = new TamanhoImagens();
$TamanhoImagens->setId_tamanho_imagens($_POST['inputIdTamanhoImagens']);
$TamanhoImagens->setTabela($_POST['inputTabela']);
$TamanhoImagens->setCampo($_POST['inputCampos']);
$TamanhoImagens->setLargura($_POST['inputLargura']);
$TamanhoImagens->setAltura($_POST['inputAltura']);

if ($TamanhoImagens->salva_dados()):
    print $TamanhoImagens->getRetorno_dados();
else:
    print 0;
endif;