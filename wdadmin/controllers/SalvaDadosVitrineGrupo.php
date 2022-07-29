<?php

require_once "../class/VitrineGrupos.class.php";

include 'MontaUrlAmigavel.php';

$VitrineGrupos = new VitrineGrupos();
$VitrineGrupos->setId_vitrine_grupo($_POST['inputIdVitrineGrupos']);
$VitrineGrupos->setDescricao($_POST['inputDescricao']);
$VitrineGrupos->setUrl_amigavel(url_amigavel($_POST['inputDescricao']));
$VitrineGrupos->setStatus($_POST['inputStatus']);

if ($VitrineGrupos->salva_dados()):
    print $VitrineGrupos->getRetorno_dados();
else:
    print 0;
endif;