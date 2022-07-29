<?php

require_once "../class/Equipe.class.php";

$Equipe = new Equipe();
$Equipe->setId_equipe($_POST['viIdEquipe']);

if ($Equipe->edita_dados()):
    print $Equipe->getRetorno_dados();
else:
    print 0;
endif;