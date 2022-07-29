<?php

require_once "../class/Usuarios.class.php";

$Usuarios = new Usuarios();

if ($Usuarios->consulta_dados()):
    print $Usuarios->getRetorno_dados();
else:
    print 0;
endif;