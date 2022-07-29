<?php

require_once "../class/TamanhoImagens.class.php";

$TamanhoImagens = new TamanhoImagens();
$TamanhoImagens->setId_tamanho_imagens($_POST['viIdTamanhoImagens']);

if ($TamanhoImagens->edita_dados()):
    print $TamanhoImagens->getRetorno_dados();
else:
    print 0;
endif;