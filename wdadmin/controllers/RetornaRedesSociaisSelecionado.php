<?php

require_once "../class/RedesSociais.class.php";

$RedesSociais = new RedesSociais();
$RedesSociais->setId_redes_sociais($_POST['viIdRedesSociais']);

if ($RedesSociais->edita_dados()):
    print $RedesSociais->getRetorno_dados();
else:
    print 0;
endif;