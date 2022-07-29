<?php
require_once "../class/Eventos.class.php";

$Eventos = new Eventos();

if ($Eventos->consulta_dados_relatorio_compras()):
    print $Eventos->getRetorno_dados();
else:
    print 0;
endif;