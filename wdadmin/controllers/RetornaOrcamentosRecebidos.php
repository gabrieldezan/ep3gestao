<?php

require_once "../class/OrcamentosRecebidos.class.php";

$OrcamentosRecebidos = new OrcamentosRecebidos();

if ($OrcamentosRecebidos->consulta_dados()):
    print $OrcamentosRecebidos->getRetorno_dados();
else:
    print 0;
endif;