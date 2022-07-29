<?php

require_once "../class/TamanhoImagens.class.php";

$TamanhoImagens = new TamanhoImagens();
$TamanhoImagens->setTabela($_POST['vsNomeTabela']);

if ($TamanhoImagens->tamanho_imagens_tela()):
    print $TamanhoImagens->getRetorno_dados();
else:
    print 0;
endif;