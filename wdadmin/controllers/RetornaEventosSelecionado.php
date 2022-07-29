<?php

require_once "../class/Eventos.class.php";

$Eventos = new Eventos();
$Eventos->setId_eventos($_POST['viIdEventos']);

if ($Eventos->edita_dados()):
    print $Eventos->getRetorno_dados();
else:
    print 0;
endif;