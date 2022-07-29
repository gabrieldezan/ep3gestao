<?php

require_once "../class/MissaoVisaoValores.class.php";

$MissaoVisaoValores = new MissaoVisaoValores();

if ($MissaoVisaoValores->edita_dados()):
    print $MissaoVisaoValores->getRetorno_dados();
else:
    print 0;
endif;