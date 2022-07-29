<?php

require_once "../class/Sobre.class.php";

$Sobre = new Sobre();

if ($Sobre->edita_dados()):
    print $Sobre->getRetorno_dados();
else:
    print 0;
endif;