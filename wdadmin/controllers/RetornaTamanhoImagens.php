<?php

require_once "../class/TamanhoImagens.class.php";

$TamanhoImagens = new TamanhoImagens();

if ($TamanhoImagens->consulta_dados()):
    print $TamanhoImagens->getRetorno_dados();
else:
    print 0;
endif;