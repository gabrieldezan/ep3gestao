<?php

require_once "../class/Equipe.class.php";

$Equipe = new Equipe();

if ($Equipe->consulta_dados()):
    print $Equipe->getRetorno_dados();
else:
    print 0;
endif;