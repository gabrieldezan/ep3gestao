<?php

require_once "../class/RedesSociais.class.php";

$RedesSociais = new RedesSociais();

if ($RedesSociais->consulta_dados()):
    print $RedesSociais->getRetorno_dados();
else:
    print 0;
endif;