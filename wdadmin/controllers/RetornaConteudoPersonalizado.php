<?php

require_once "../class/ConteudoPersonalizado.class.php";

$ConteudoPersonalizado = new ConteudoPersonalizado();

if ($ConteudoPersonalizado->consulta_dados()):
    print $ConteudoPersonalizado->getRetorno_dados();
else:
    print 0;
endif;