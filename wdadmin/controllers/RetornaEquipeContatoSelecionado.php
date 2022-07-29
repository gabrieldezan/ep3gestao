<?php

require_once "../class/EquipeContato.class.php";

$EquipeContato = new EquipeContato();
$EquipeContato->setId_equipe_contato($_POST['IdEquipeContato']);

if ($EquipeContato->edita_dados()):
    print $EquipeContato->getRetorno_dados();
else:
    print 0;
endif;