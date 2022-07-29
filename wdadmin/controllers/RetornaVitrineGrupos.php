<?php

require_once "../class/VitrineGrupos.class.php";

$VitrineGrupos = new VitrineGrupos();

if ($VitrineGrupos->consulta_dados()):
    print $VitrineGrupos->getRetorno_dados();
else:
    print 0;
endif;