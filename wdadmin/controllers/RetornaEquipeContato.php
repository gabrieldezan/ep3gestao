<?php

require_once "../class/EquipeContato.class.php";

$EquipeContato = new EquipeContato();

$EquipeContato->setId_equipe($_POST['viIdEquipe']);

if ($EquipeContato->consulta_dados()):
    print $EquipeContato->getRetorno_dados();
else:
    print 0;
endif;