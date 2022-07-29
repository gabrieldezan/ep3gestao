<?php

require_once "../class/Acessos.class.php";

$Acessos = new Acessos();

if ($Acessos->consulta_acessos_bloqueados()):
    print $Acessos->getRetorno_dados();
else:
    print 0;
endif;