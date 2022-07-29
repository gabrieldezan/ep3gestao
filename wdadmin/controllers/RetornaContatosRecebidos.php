<?php

require_once "../class/ContatosRecebidos.class.php";

$ContatosRecebidos = new ContatosRecebidos();

if ($ContatosRecebidos->consulta_dados()):
    print $ContatosRecebidos->getRetorno_dados();
else:
    print 0;
endif;