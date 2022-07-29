<?php

require_once "../class/Planos.class.php";

$Planos = new Planos();

if ($Planos->consulta_dados()):
    print $Planos->getRetorno_dados();
else:
    print 0;
endif;