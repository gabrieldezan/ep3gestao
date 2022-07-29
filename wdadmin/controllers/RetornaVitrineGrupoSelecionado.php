<?php

require_once "../class/VitrineGrupos.class.php";

$VitrineGrupos = new VitrineGrupos();
$VitrineGrupos->setId_vitrine_grupo($_POST['viIdVitrineGrupos']);

if ($VitrineGrupos->edita_dados()):
    print $VitrineGrupos->getRetorno_dados();
else:
    print 0;
endif;