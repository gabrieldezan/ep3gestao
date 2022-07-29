<?php

require_once "../class/Usuarios.class.php";

$Usuarios = new Usuarios();
$Usuarios->setId_usuarios($_POST['viIdUsuario']);

if ($Usuarios->edita_dados()):
    print $Usuarios->getRetorno_dados();
else:
    print 0;
endif;