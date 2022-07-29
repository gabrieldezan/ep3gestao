<?php

require_once "../class/VitrineSubgrupos.class.php";

$VitrineSubgrupos = new VitrineSubgrupos();
$VitrineSubgrupos->setId_vitrine_grupo($_POST['inputFiltroIdGrupoVitrine']);

if ($VitrineSubgrupos->consulta_dados()):
    print $VitrineSubgrupos->getRetorno_dados();
else:
    print 0;
endif;