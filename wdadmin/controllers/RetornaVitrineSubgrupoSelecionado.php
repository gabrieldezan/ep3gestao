<?php

require_once "../class/VitrineSubgrupos.class.php";

$VitrineSubgrupos = new VitrineSubgrupos();
$VitrineSubgrupos->setId_vitrine_subgrupo($_POST['viIdVitrineSubgrupo']);

if ($VitrineSubgrupos->edita_dados()):
    print $VitrineSubgrupos->getRetorno_dados();
else:
    print 0;
endif;