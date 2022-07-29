<?php

require_once "../class/ConteudoPersonalizado.class.php";

$ConteudoPersonalizado = new ConteudoPersonalizado();
$ConteudoPersonalizado->setId_conteudo_personalizado($_POST['viIdConteudoPersonalizado']);

if ($ConteudoPersonalizado->edita_dados()):
    print $ConteudoPersonalizado->getRetorno_dados();
else:
    print 0;
endif;