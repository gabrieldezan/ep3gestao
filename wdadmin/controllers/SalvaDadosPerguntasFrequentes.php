<?php

require_once "../class/PerguntasFrequentes.class.php";

$PerguntasFrequentes = new PerguntasFrequentes();
$PerguntasFrequentes->setId_perguntas_frequentes($_POST['inputIdPerguntasFrequentes']);
$PerguntasFrequentes->setNumero($_POST['inputNumero']);
$PerguntasFrequentes->setPergunta($_POST['inputPergunta']);
$PerguntasFrequentes->setResposta($_POST['inputResposta']);

if ($PerguntasFrequentes->salva_dados()) {
    print $PerguntasFrequentes->getRetorno_dados();
} else {
    print 0;
}