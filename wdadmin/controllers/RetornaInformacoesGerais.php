<?php

require_once "../class/InformacoesGerais.class.php";

$InformacoesGerais = new InformacoesGerais();

if ($InformacoesGerais->edita_dados()):
    print $InformacoesGerais->getRetorno_dados();
else:
    print 0;
endif;