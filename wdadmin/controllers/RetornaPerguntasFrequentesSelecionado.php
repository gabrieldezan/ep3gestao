<?php

require_once "../class/PerguntasFrequentes.class.php";

$PerguntasFrequentes = new PerguntasFrequentes();
$PerguntasFrequentes->setId_perguntas_frequentes($_POST['viIdPerguntasFrequentes']);

if ($PerguntasFrequentes->edita_dados()):
    print $PerguntasFrequentes->getRetorno_dados();
else:
    print 0;
endif;